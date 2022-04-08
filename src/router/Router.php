<?php
namespace app\router;

class Router
{
    private RequestInterface $request;
    private array $supportedMethods = array(
        "GET",
        "POST",
    );

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    function __call($name, $args)
    {
        list($route, $method) = $args;

        if(!in_array(strtoupper($name), $this->supportedMethods))
        {
            $this->invalidMethodHandler();
        }

        $this->{strtolower($name)}[$route] = $method;
    }

    private function invalidMethodHandler(): void
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function notFoundMethodHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        foreach ($methodDictionary as $route => $methodData) {
            $pattern = "@^" . preg_replace('/:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', $route) . "$@D";

            $params = [];

            $match = preg_match($pattern, $this->request->requestUri, $params);
            if($match) {
                array_shift($params);
                list($class, $method) = $methodData;

                return (new $class())->$method($params[0]);
            }
        }

        $this->notFoundMethodHandler();
    }

    function __destruct()
    {
        $this->resolve();
    }

}