<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

define('KERNEL', true);
define('APP_VERSION', 'ImageHosting v.1.0.0');

define('DIR_UPLOAD', '../files/');
define('ALLOWED_TYPES', ['gif', 'jpg', 'jpeg', 'png', 'jpe'], true);
define('TEMPLATES_DIR', './templates');
define('CACHE_DIR', './var/cache');

// UNIQUE, TEMP, FILENAME
define('FILENAME_TYPE', 'UNIQUE');
