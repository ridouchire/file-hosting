<?php

namespace Controllers;
use Controllers\IController;
use IH\App;
use IH\Router;

class NotFound implements IController
{
    /**
     * Handler request GET method
     *
     * @return void
     */
    public function get()
    {
        $controller = App::get('request')->controller;
        echo("Controller '{$controller}' not found.");
        var_dump(App::get('request')->params);
    }

    /**
     * Handler request POST method
     *
     * @return void
     */
    public function post()
    {
        echo("Method not allowed");
    }
}
