<?php
/**
 * ............/´¯/)...............(\¯`\
 * .........../...//....ЗДОХНИ.....\\...\
 * ........../...//......ФАШИСТ.....\\... \
 * ...../´¯/..../´¯\.ЕБАНЫй.../¯` \....\.....\´¯\
 * .././.../..../..../.|_......._|.\....\....\...\.\
 * (.(....(....(..../..)..)…...(..(.\....)....)....).)
 * .\................\/.../......\...\/................/
 * ..\.................. /.........\................../
 */

if (!defined('KERNEL')) {
    die("Access denied");
}

define('APP_VERSION', '1.0.3');
define('DIR_UPLOAD', '../files/');
define('ALLOWED_TYPES', ['gif', 'jpg', 'jpeg', 'png', 'jpe'], true);
define('FILENAME_TYPE', 'UNIQUE');
define('SUPPORT_EMAIL', 'support@example.com');
define('UPLOAD_ERR_UNSUPPORTED', 9);
define('TEST_SALT', '1010101');
define('ALLOWED_TYPES', ['gif', 'jpg', 'jpeg', 'png', 'jpe'], true);

if (is_file('./local_conf.php')) {
    require './local_conf.php';
}

if (defined('DEVELOPMENT')) {
    error_reporting(-1);
    define('DEBUG', true);
}
