<?php
namespace app\router;

class Request implements RequestInterface
{

    public function __construct()
    {
        $this->prepare();
    }

    private function prepare(): void
    {
        foreach($_SERVER as $key => $value)
        {
            $this->{$this->toLowerCamelCase($key)} = $value;
        }
    }

    private function toLowerCamelCase(string $string): string
    {
        return lcfirst(str_replace('_', '', ucwords(strtolower($string), '_')));
    }

    public function getBody(): array
    {
        if ('POST' === $this->requestMethod) {
            $body = [];
            foreach($_POST as $key => $value)
            {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $body;
        }

        return [];
    }

}