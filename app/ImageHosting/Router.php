<?php

namespace IH;
use IH\App;

class Router
{
    public static function requestHandler()
    {
        $request = App::get('request');

        if (self::getRouteHandler($request->controller) === false) {
            self::getRouteHandler('404')->get();
        } else {
            $controller = self::getRouteHandler($request->controller);
            $method = strtolower($request->method);
            $controller->$method();
            $response = App::get('response');
            $response->send();
        }
    }

    public static function addRouteHandler(string $route, object $controller)
    {
        App::set('route.' . $route, $controller);
    }

    /**
     * Gets route handler
     *
     * @param string $controller Controller name
     *
     * @return object
     */
    public static function getRouteHandler(string $controller)
    {
        if (App::get('route.' . $controller) === null) {
            return false;
        } else {
            return App::get('route.' . $controller);
        }
    }
}
