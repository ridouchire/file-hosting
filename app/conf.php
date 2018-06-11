<?php

define('KERNEL', true);
define('APP_VERSION', 'ImageHosting v.0.2.2-dev');
define('DIR_UPLOAD', '../files/');
define('ALLOWED_TYPES', ['gif', 'jpg', 'jpeg', 'png', 'jpe'], true);
// UNIQUE, TEMP, FILENAME
define('FILENAME_TYPE', 'UNIQUE');

ini_set('display_errors', true);
error_reporting(E_ALL);
