<?php

if (is_dir(__DIR__.'/files') == false) {
    echo 'Please execute install.php for create directories application';
    die();
}

require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'app/functions/common.php';

fn_get_schemas();
require(ROOT . '/app/schemas/menu.php');

$loader = new Twig\Loader\FilesystemLoader(TEMPLATES_DIR);

if (defined('CACHE_DIR')) {
    $twig = new Twig\Environment($loader, [(CACHE_DIR)]);
} else {
    $twig = new Twig\Environment($loader, [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['test']) || $_POST['test'] !== '1010101') {
        $notice = fn_set_notification('error', 'Go back, fucking roobots');
        echo $twig->render(
            'index.html',
            [
                'title' => APP_VERSION,
                'menu'  => 'Upload',
                'notice' => $notice,
            ]
        );
        exit;
    } else {
        if ($_FILES) {
            fn_processed_upload_files($_FILES);
        } else {
            $notice = fn_set_notification('error', 'No files were uploaded');
        }
    }
}

echo $twig->render(
    'index.html',
    [
        'title' => APP_VERSION,
        'menu' => $schemas['menu'],
    ]
);

echo $twig->render(
    'upload.html',
    []
);
