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

if (!defined('KERNEL')) {
    die("Access denied");
}

/**
 * Set notification on website
 *
 * @param $type string Type notification
 * @param $message string Message notification
 *
 * @return array|false
 */
function fn_set_notification($type, $message)
{
    $notice = array();

    if ($type == 'error') {
        $notice['name'] = 'Error';
    } elseif ($type == 'warning') {
        $notice['name'] = 'Warning';
    } else {
        return false;
    }

    if ($message == null) {
        return false;
    } else {
        $notice['message'] = $message;
    }

    return $notice;
}

/**
 * Generate filename
 *
 * @param $ext          string Extension file
 * @param $filename     string Original name file
 * @param $type         string Type generate name file
 * @param $tempname     string Temporary name file
 *
 * @return string
 */
function fn_generate_filename($ext, $filename = '', $type = FILENAME_TYPE)
{
    if ($type == 'UNIQUE') {
        $name = uniqid();
        $filename = $name.'.'.$ext;
    } elseif ($type == 'TEMP' && !empty($filename)) {
        $filename = $filename.'.'.$ext;
    } elseif ($type == 'FILENAME' && !empty($filename)) {
        $filename = explode('/', $filename);
        $filename = end($filename);
        $filename = htmlentities($filename);
        $filename = stripslashes($filename);
        $filename = strtolower($filename);
        $filename = preg_replace("#[^a-z0-9_.-]#i", "", $filename);
    } else {
        return false;
    }

    return $filename;
}

/**
 * Check supported file type
 *
 * @param $ext Extension upload file
 *
 * @return boolean
 */
function fn_check_filetype($ext)
{
    if (!in_array($ext, ALLOWED_TYPES)) {
        return false;
    }

    return true;
}

/**
 * Set file permission
 *
 * @param $path_file Full path file
 *
 * @return boolean
 */
function fn_chmod($path_file)
{
    if (!$path_file) {
        return false;
    }

    try {
        chmod($path_file, 0666);
    } catch (Exception $e) {
        return false;
    }

    return true;
}

/**
 * Move uploaded file to directory
 *
 * @param $temp_path Temporary path to uploaded file.
 * @param $path      Path where file will be moved.
 *
 * @return boolean
 */
function fn_move_uploaded_file_to_dir($temp_path, $path)
{
    $is_moved = move_uploaded_file($temp_path, $path);
    $is_check_permission = fn_chmod($path);

    if ($is_moved == false || $is_check_permission == false) {
        return false;
    }

    return true;
}
