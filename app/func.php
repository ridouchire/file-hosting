<?php

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
 * @param string $filename Original name file
 * @param string $tempnaem Temporary name file
 * @param string FILENAME_TYPE Type generate name file
 *
 * @return string
 */
function fn_generate_filename($filename, $tempname, $type = FILENAME_TYPE)
{
    if ($type == 'UNIQUE') {
        $name = uniqid();
        $filename = $name;
    } elseif ($type == 'TEMP') {
        $filename = $tempname;
    } elseif ($type == 'FILENAME') {
        $filename = htmlentities($filename);
        $filename = stripslashes($filename);
        $filename = strtolower($filename);
        $filename = preg_replace("#[^a-z0-9_.-]#i", "", $filename);
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

/** Set file permission
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
