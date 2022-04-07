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
        $method = $methodDictionary[$this->request->requestUri];

        if(is_null($method))
        {
            $this->notFoundMethodHandler();
            return;
        }

        echo call_user_func_array($method, array($this->request));
    }

    function __destruct()
    {
        $this->resolve();
    }

}