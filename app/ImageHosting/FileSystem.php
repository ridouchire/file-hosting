<?php

namespace IH;

class FileSystem
{
    public static function generateFilename(
        $extension,
        $filename,
        $type = FILENAME_TYPE
    )
    {
        if ($type == 'UNIQUE') {
            return uniqid() . '.' . $extension;
        } elseif ($type == 'TEMP' && !empty($filename)) {
            return $filename . '.' . $extension;
        } elseif ($type == 'FILENAME' && !empty($filename)) {
            $filename = explode('/', $filename);
            $filename = end($filename);
            $filename = htmlentities($filename);
            $filename = stripcslashes($filename);
            $filename = strtolower($filename);
            $filename  = preg_replace("#[^a-z0-9_.-]#i", "", $filename);
            return $filename;
        }

        return false;
    }

    /**
     * Check supported file type
     *
     * @param string $extension Extension upload file
     *
     * @return boolean
     */
    public static function checkFiletype($extension)
    {
        if (!in_array($extension, ALLOWED_TYPES)) {
            return false;
        }

        return true;
    }

    public static function setPermission($path_file, $permission = 0666)
    {
        if (!$path_file) {
            return false;
        }

        try {
            chmod($path_file, $permission);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Move uploaded file to directory
     *
     * @param string $temp_path Temporary path to uploaded file
     * @param string $path      Path where file will be moved
     *
     * @return boolean
     */
    public static function moveUploadedFileToDir($temp_path, $path)
    {
        $is_moved = move_uploaded_file($temp_path, $path);
        $is_check_permission = self::setPermission($path);

        if (!$is_moved || !$is_check_permission) {
            return false;
        }

        return true;
    }

    public static function getSchema($name = '')
    {
        if (file_exists(DIR_APP . "/schemas/$name.php")) {
            $schema = include_once(DIR_APP . "/schemas/$name.php");
            return $schema;
        }

        return false;
    }
}
