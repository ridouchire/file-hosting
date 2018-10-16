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

define('KERNEL', true);
require "./app/conf.php";

if (is_dir(__DIR__ . '/files') == false) {
    echo 'Please execute install.php for create directories application';
    die;
}

if (defined('DEVELOPMENT') && isset($_REQUEST['version'])) {
    var_dump(get_defined_vars());
    echo APP_VERSION;
    die;
}

require "./templates/index.html";
require "./templates/upload.html";
