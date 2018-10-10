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

define('APP_VERSION', 'ImageHosting v.1.0.2');
define('DIR_UPLOAD', '../files/');
define('ALLOWED_TYPES', ['gif', 'jpg', 'jpeg', 'png', 'jpe'], true);
// UNIQUE, TEMP, FILENAME
define('FILENAME_TYPE', 'UNIQUE');

define('UPLOAD_ERR_UNSUPPORTED', 9);

ini_set('display_errors', true);
error_reporting(E_ALL);
