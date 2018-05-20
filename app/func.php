<?php

/**
 * Generate filename
 *
 * @param string $filename Original name file
 * @param string $tempnaem Temporary name file
 *
 * @return string
 */
function fn_generate_filename($filename, $tempname)
{
    $filename = htmlentities($filename);
    $filename = stripslashes($filename);
    $filename = strtolower($filename);
    $filename = preg_replace("#[^a-z0-9_.-]#i", "", $filename);
    $filename = $tempname.$filename;

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
