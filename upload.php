<?php

if (!isset($_POST['test'])) {
    die("Error: fuck off");
}

/**
 * Set files permission
 *
 * @param $files array List files
 *
 * @return boolean
 */
function fs_chmod($files)
{
    if (!$files) {
        return false;
    }

    foreach ($files as $file) {
        try {
            chmod($file, 0666);
        } catch (Exception $e) {
            return false;
        }
    }

    return true;
}

$uploaddir = "./files/";

$files = array();
$files_full_path = array();

foreach ($_FILES["pictures"]["error"] as $key => $error) {
    
    if ($error == UPLOAD_ERR_OK) {
        
        $user_filename = preg_replace("#[^a-z0-9_.-]#i", "", strtolower(stripslashes(htmlentities($_FILES['pictures']['name'][$key]))));

        $prefix = explode('/', $_FILES['pictures']['tmp_name'][$key]);
        $prefix = $prefix[2];
        $user_filename = $prefix.''.$user_filename;
        $filename = $uploaddir.basename($user_filename);
       
        copy($_FILES["pictures"]["tmp_name"][$key], $filename);
        $files[] = $user_filename;
        $files_full_path[] = $filename;
    }
    fs_chmod($files_full_path);
}
include "list.html";
