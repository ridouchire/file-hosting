<?php

define('KERNEL', true);
require_once 'conf.php';
require_once 'func.php';

$files  = array();
$notice = false;

if (empty($_POST) || !isset($_POST['test']) || $_POST['test'] !== TEST_SALT) {
    $notice = fn_set_notification('error', 'Go back, fucking robots');
} else {
    foreach ($_FILES['pictures']['error'] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $ext = explode('/', $_FILES['pictures']['type'][$key]);
            $ext = end($ext);

            if (fn_check_filetype($ext) === false) {
                $error = UPLOAD_ERR_UNSUPPORTED;
                $notice = fn_set_notification('error', 'Attempt to upload an unsupported file type');
            }

            $temp     = $_FILES['pictures']['tmp_name'][$key];
            $tempname = explode('/', $temp);
            $tempname = end($tempname);
            $filename = fn_generate_filename($_FILES['pictures']['name'][$key], $tempname, $ext);
            $filename = $filename;
            $filepath = DIR_UPLOAD.basename($filename);

            if ($error !== UPLOAD_ERR_UNSUPPORTED) {
                if (!fn_move_uploaded_file_to_dir($temp, $filepath) === false) {
                    $files[] = $filename;
                    $paths   = $filepath;
                } else {
                    $notice = fn_set_notification('warning', 'Can not change file permission');
                }
            }
        }
    }

    if (empty($files)) {
        $notice = fn_set_notification('error', 'No files were uploaded.');
    }
}

require "../templates/index.html";
require '../templates/list.html';
