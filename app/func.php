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
    die('Access denied');
}

/**
 * Set notification on website
 *
 * @param string $type    Type notification
 * @param string $message Message notification
 *
 * @return array|false
 */
function fn_set_notification($type, $message)
{
    $notice = [];

    if (!isset($type) && !isset($message)) {
        return false;
    }

    if ($type == 'error' || $type == 'warning') {
        $notice = [
            'name' => strtoupper($type),
            'message' => $message,
        ];
        return $notice;
    }
    return false;
}

/**
 * Generate filename
 *
 * @param string $ext      Extension file
 * @param string $filename Original name file
 * @param string $type     Type generate name file
 *
 * @return string
 */
function fn_generate_filename($ext, $filename = '', $type = FILENAME_TYPE)
{
    if ($type == 'UNIQUE') {
        return uniqid() . '.' . $ext;
    } elseif ($type == 'TEMP' && !empty($filename)) {
        return $filename.'.'.$ext;
    } elseif ($type == 'FILENAME' && !empty($filename)) {
        $filename = explode('/', $filename);
        $filename = end($filename);
        $filename = htmlentities($filename);
        $filename = stripslashes($filename);
        $filename = strtolower($filename);
        $filename = preg_replace('#[^a-z0-9_.-]#i', '', $filename);
        return $filename;
    }

    return false;
}

/**
 * Check supported file type
 *
 * @param string $ext Extension upload file
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
 * @param string $path_file Full path file
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
 * @param string $temp_path Temporary path to uploaded file.
 * @param string $path      Path where file will be moved.
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
