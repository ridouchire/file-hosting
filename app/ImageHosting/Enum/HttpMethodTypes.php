<?php

namespace IH\Enum;
use IH\Enum\IEnum;

class HttpMethodTypes
{
    const POST  = 'POST';
    const GET   = 'GET';

    /**
     * Gets all HTTP methods
     *
     * @return array
     */
    public static function getAll()
    {
        return array(
            self::POST,
            self::GET,
        );
    }

    public static function getItem() {}
}
