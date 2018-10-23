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
require_once 'conf.php';
require_once 'func.php';

$files  = [];
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
            } else {
                $filename = fn_generate_filename($ext);
                if ($filename == false) {
                    fn_set_notification('error',
                        'Error occured. Please contact server administrator: <a href="'
                        . SUPPORT_EMAIL
                        . '">E-Mail</a>'
                    );
                }
                $filepath = DIR_UPLOAD.basename($filename);

                if (!fn_move_uploaded_file_to_dir($_FILES['pictures']['tmp_name'][$key], $filepath) === false) {
                    $files[] = $filename;
                    $paths   = $filepath;
                } else {
                    $notice = fn_set_notification('warning', 'Can not change file permission');
                }
            }
        } else {
            $notice = fn_set_notification('error', 'No files were uploaded.');
        }
    }
}

require "../templates/index.html";
require '../templates/list.html';
