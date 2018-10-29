<?php

namespace IH\Enum;
use IH\Enum\IEnum;

class HttpCodeTypes implements IEnum
{
    const OK           = 200;
    const NOT_FOUND    = 404;
    const NOT_ALLOWED  = 405;
    const SERVER_ERROR = 500;

    public static function getAll()
    {
        return array(
            self::OK,
            self::NOT_FOUND,
            self::NOT_ALLOWED,
            self::SERVER_ERROR
        );
    }

    public static function getItem() {}
}
