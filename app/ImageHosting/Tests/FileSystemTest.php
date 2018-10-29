<?php

namespace IH\Tests;

use IH\FileSystem;
use PHPUnit\Framework\TestCase;

class FileSystemTest extends TestCase
{
    public function fnGenerateFilenameDataProvider()
    {
        return [
            [
                'jpg',
                'name#53.jpg',
                'FILENAME',
                'name53.jpg',
            ],
            [
                'png',
                'temp',
                'TEMP',
                'temp.png',
            ],
            [
                'png',
                null,
                'TEMP',
                false,
            ],
            [
                'jpg',
                null,
                'FILENAME',
                false,
            ]
        ];
    }

    /**
     * @dataProvider fnGenerateFilenameDataProvider
     */
    public function testFnGenerateFilename($extension, $filename, $type, $expected)
    {
        $this->assertEquals($expected, FileSystem::generateFilename($extension, $filename, $type));
    }
}
