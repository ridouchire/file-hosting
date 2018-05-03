<?php

if (!isset($_POST['test'])) {
    die("Error: fuck off");
}

$uploaddir = "./files/";

$files = array();

foreach ($_FILES["pictures"]["error"] as $key => $error) {
    
    if ($error == UPLOAD_ERR_OK) {
        
        $file = preg_replace("#[^a-z0-9_.-]#i", "", strtolower(stripslashes(htmlentities($_FILES['pictures']['name'][$key]))));
        $filename = $uploaddir.basename($file);
        copy($_FILES["pictures"]["tmp_name"][$key], $filename);
        $files[] = $file;
    }
}
include "list.html";
