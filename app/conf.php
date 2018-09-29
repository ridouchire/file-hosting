<?php

define('KERNEL', true);
define('APP_VERSION', 'ImageHosting v.1.0.0');
define('DIR_UPLOAD', '../files/');
define('ALLOWED_TYPES', ['gif', 'jpg', 'jpeg', 'png', 'jpe'], true);
// UNIQUE, TEMP, FILENAME
define('FILENAME_TYPE', 'UNIQUE');

define('UPLOAD_ERR_UNSUPPORTED', 9);

ini_set('display_errors', true);
error_reporting(E_ALL);
