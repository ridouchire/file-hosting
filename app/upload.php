<?php

require_once 'conf.php';
require_once 'func.php';

$files           = array();
$files_full_path = array();
$notice          = false;


if (empty($_POST) || !isset($_POST['test']) || $_POST['test'] !== '1010101') {
    $notice = fn_set_notification('error', 'Go back, fucking robots');
} else {
    foreach ($_FILES['pictures']['error'] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $ext = explode('/', $_FILES['pictures']['type'][$key]);
            $ext = end($ext);

            if (fn_check_filetype($ext) === false) {
                $notice = fn_set_notification('error', 'Attempt to upload an unsupported file type');
            }

            $temp     = $_FILES['pictures']['tmp_name'][$key];
            $tempname = explode('/', $temp);
            $tempname = end($tempname);
            $filename = fn_generate_filename($_FILES['pictures']['name'][$key], $tempname, $ext);
            $filename = $filename;
            $filepath = DIR_UPLOAD.basename($filename);
            move_uploaded_file($temp, $filepath);
            if (!fn_chmod($filepath) === false) {
                $files[] = $filename;
                $paths   = $filepath;
            } else {
                $notice = fn_set_notification('warning', 'Can not change file permission');
            }
        }
    }

    if (empty($files)) {
        $notice = fn_set_notification('error', 'No files were uploaded.');
    }
}

if ($notice !== false) {
    require "../templates/index.html";
} else {
    require "../templates/index.html";
    require '../templates/list.html';
}
