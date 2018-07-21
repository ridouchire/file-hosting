<?php

if (!defined('KERNEL')) {
    echo 'Access denied';
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

}//end fn_set_notification()


/**
 * Generate filename
 *
 * @param $filename     string Original name file
 * @param $tempname     string Temporary name file
 * @param $ext          string Extension file
 * @param FILENAME_TYPE string Type generate name file
 *
 * @return string
 */
function fn_generate_filename($filename, $tempname, $ext, $type = FILENAME_TYPE)
{
    if ($type == 'UNIQUE') {
        $name     = uniqid();
        $filename = $name.'.'.$ext;
    } elseif ($type == 'TEMP') {
        $filename = $tempname.'.'.$ext;
    } elseif ($type == 'FILENAME') {
        $filename = htmlentities($filename);
        $filename = stripslashes($filename);
        $filename = strtolower($filename);
        $filename = preg_replace('#[^a-z0-9_.-]#i', '', $filename);
    }

    return $filename;

}//end fn_generate_filename()


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

}//end fn_check_filetype()


/**
 * Set file permission
 *
 * @param $path_file Full path file
 *
 * @return boolean
 *
 * @throws Exception
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

}//end fn_chmod()


/**
 * Get schemas
 *
 * @return array
 *
 * @throws Exception
 */
function fn_get_schemas()
{
    $paths = glob(ROOT.'/app/schemas/*.php');
    global $schemas;

    foreach ($paths as $path) {
        include $path;
    }

    return $schemas;

}//end fn_get_schemas()
