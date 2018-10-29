<?php

namespace IH;

class App
{
    /** @var array storage */
    static private $map;

    /**
     * Gets variable by key
     *
     * @param string $key Key name 
     * 
     * @return mixed
     */
    public static function get($key)
    {
        if (!isset(self::$map[$key]) && self::$map[$key] === false) {
            return false;
        }

        return self::$map[$key];
    }

    /**
     * Puts variable by key
     *
     * @param string $key      Key name
     * @param mixed  $variable Variable: object, array, int, string, etc.
     *
     * @return bool always true
     */
    public static function set($key, $variable)
    {
        if (self::$map === null) {
            self::$map = array();
        }
        self::$map[$key] = $variable;

        return true;
    }
}
