<?php

namespace IH\Enum;

interface IEnum
{
    /**
     * Gets all Enum values
     *
     * @return array
     */
    public static function getAll();

    /**
     * Gets Enum element value
     */
    public static function getItem();
}
