<?php

$uploaddir = "./files/";

$files = array();
$files_full_path = array();

$list_allowed_types = array(
    "gif",
    "jpg",
    "jpeg",
    "png",
);


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

foreach ($_FILES["pictures"]["error"] as $key => $error) {
    
    if ($error == UPLOAD_ERR_OK) {
        
        $user_filename = preg_replace("#[^a-z0-9_.-]#i", "", strtolower(stripslashes(htmlentities($_FILES['pictures']['name'][$key]))));
        $ext = explode('/', $_FILES['pictures']['type'][$key]);
        $ext = end($ext);

        if (!in_array($ext, $list_allowed_types)) {
            die("Error: Attempt to upload an unsupported file type");
        }

        $prefix = explode('/', $_FILES['pictures']['tmp_name'][$key]);
        $prefix = end($prefix);
        $user_filename = $prefix.''.$user_filename;
        $filename = $uploaddir.basename($user_filename);
       
        copy($_FILES["pictures"]["tmp_name"][$key], $filename);
        $files[] = $user_filename;
        $files_full_path[] = $filename;
    } else {
        die('Error: No files to upload');
    }
    fs_chmod($files_full_path);
}
include "list.html";
