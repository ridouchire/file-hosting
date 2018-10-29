<?php

namespace Controllers;
use Controllers\IController;
use IH\App;
use IH\Router;

class Ping implements IController
{
    /**
     * Handler request GET method
     *
     * @return void
     */
    public function get()
    {
        $response = App::get('response');
        $response
            ->setData(
                array(
                    'error'   => 200,
                    'message' => 'Pong',
                    'time'    => round(microtime(true) - TIME_START, 4)
                )
            )
            ->setCode(200);
    }

    /**
     * Handler request POST method
     *
     * @return void
     */
    public function post()
    {
        $response = App::get('response');
        $response
            ->setData(
                array(
                    'error' => 405,
                    'message' => 'Method not allowed'
                )
            )
            ->setCode(405);
    }
}
