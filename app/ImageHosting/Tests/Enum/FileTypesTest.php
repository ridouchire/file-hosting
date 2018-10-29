<?php

namespace IH\Tests;
use PHPUnit\Framework\TestCase;
use IH\Enum\FileTypes;

class FileTypesTests extends TestCase
{
    /**
     * @dataProvider dpTestGetAll
     */
    public function testGetAll($expected)
    {
        $this->assertEquals($expected, FileTypes::getAll());
    }

    public function dpTestGetAll()
    {
        return array(
            array(
                array(
                'image/gif',
                'image/jpeg',
                'image/png',
                )
            )
        );
    }
}
