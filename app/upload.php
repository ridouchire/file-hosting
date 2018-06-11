<?php

require_once 'conf.php';
require_once 'func.php';

require "../templates/index.html";

$files           = array();
$files_full_path = array();

foreach ($_FILES['pictures']['error'] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $ext = end(explode('/', $_FILES['pictures']['type'][$key]));
        
        if (fn_check_filetype($ext) === false) {
            die('Attempt to upload an unsupported file type');
        }

        $temp     = $_FILES['pictures']['tmp_name'][$key];
        $tempname = end(explode('/', $temp));
        $filename = fn_generate_filename($_FILES['pictures']['name'][$key], $tempname);
        $filepath = DIR_UPLOAD.basename($filename);
        move_uploaded_file($temp, $filepath);
        if (!fn_chmod($filepath) === false) {
            $files[] = $filename;
            $paths   = $filepath;
        } else {
            die('Can not change file permission');
        }
    }
}
require '../templates/list.html';
