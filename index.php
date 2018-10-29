<?php

require('vendor/autoload.php');
require('config.php');

use IH\App;
use IH\Http\Request;
use IH\Http\Response;
use IH\Router;

if (version_compare(phpversion(), '7.2.0', '<')) {
    echo('Currently your PHP version is not supported.'
         . ' Minimal required PHP version is 7.2.0'
    );
    die;
}

if (is_dir(DIR_UPLOAD) == false) {
    echo 'Please execute install.php for create directories application';
    die;
}

Router::addRouteHandler('404', new Controllers\NotFound);
Router::addRouteHandler('ping', new Controllers\Ping);

App::set('request', new Request(array_merge($_GET, $_POST), $_SERVER));
App::set('response', new Response());
App::set('router', new Router());

Router::requestHandler();
