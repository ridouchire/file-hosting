<?php

require_once 'vendor/autoload.php';
require_once 'app/conf.php';

$loader = new Twig\Loader\FilesystemLoader(TEMPLATES_DIR);

if (defined('CACHE_DIR')) {
    $twig = new Twig\Environment($loader, array(CACHE_DIR));
} else {
    $twig = new Twig\Environment($loader, array());
}

echo $twig->render(
    'index.html',
    array(
     'title' => APP_VERSION,
     'menu'  => 'Upload',
    )
);

if (is_dir(__DIR__.'/files') == false) {
    echo 'Please execute install.php for create directories application';
    die();
}

// require "./templates/index.html";
require './templates/upload.html';
