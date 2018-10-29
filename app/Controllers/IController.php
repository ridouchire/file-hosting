<?php

namespace Controllers;

interface IController
{
    /**
     * Handler for request GET method
     *
     * @return array
     */
    public function get();

    /**
     * Handler for request POST method
     *
     * @return array
     */
    public function post();
}
