<?php

define('APP_VERSION', '1.1.0');
define('DIR_APP', dirname(__FILE__));
define('DIR_UPLOAD', DIR_APP . '/files');
define('DIR_TEMPLATES', DIR_APP . '/templates/');
define('FILENAME_TYPE', 'UNIQUE');
define('ALLOWED_TYPES', ['gif', 'jpg', 'jpeg', 'png', 'jpe'], true);
define('SUPPORT_EMAIL', 'support@example.com');
define('TIME_START', microtime(true));

if (is_file(DIR_APP . '../local_conf.php')) {
    require './local_conf.php';
}

if (defined('DEVELOPMENT')) {
    error_reporting(-1);
    define('DEBUG', true);
}
