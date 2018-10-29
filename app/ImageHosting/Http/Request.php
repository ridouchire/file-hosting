<?php

namespace IH\Http;
use IH\Enum\HttpMethodTypes;

class Request
{
    /** @var array Request parameters */
    public $params = array();

    /** @var string HTTP method */
    public $method;

    /** @var string Controller name */
    public $controller;

    public function __construct(array $params, array $server)
    {
        $this->method = $this->getMethod($server);
        list($this->params, $this->controller) = $this->getController($server);
        $this->params = array_merge($this->params, $params);
    }

    /**
     * Gets HTTP request method
     *
     * @param array $server Global $_SERVER array variables
     *
     * @return string|false
     */
    private function getMethod(array $server): string
    {
        if ($server['REQUEST_METHOD'] == HttpMethodTypes::POST) {
            return  HttpMethodTypes::POST;
        } elseif ($server['REQUEST_METHOD'] == HttpMethodTypes::GET) {
            return HttpMethodTypes::GET;
        }

        return false;
    }

    /**
     * Gets request controller
     *
     * @param array $server Global $_SERVER array variables
     *
     * @return array
     */
    private function getController(array $server): array
    {
        $url_data = parse_url($server['REQUEST_URI']);
        parse_str($url_data['query'], $params);
        $controller = ltrim($url_data['path'], '/');

        return array($params, $controller);
    }
}
