<?php

define('KERNEL', true);
require "./app/conf.php";

if (is_dir(__DIR__ . '/files') == false) {
    echo 'Please execute install.php for create directories application';
    die();
}

require "./templates/index.html";
require "./templates/upload.html";
