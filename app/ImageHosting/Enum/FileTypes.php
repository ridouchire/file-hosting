<?php

namespace IH\Enum;
use IH\Enum\IEnum;

class FileTypes implements IEnum
{
    const GIF = 'image/gif';
    const JPG = 'image/jpeg';
    const PNG = 'image/png';

    public static function getAll()
    {
        return array(
            self::GIF,
            self::JPG,
            self::PNG
        );
    }

    public static function getItem() {}
}
