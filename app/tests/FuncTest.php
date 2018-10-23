<?php

namespace IHTests;

use PHPUnit\Framework\TestCase;

define('KERNEL', true);

require(__DIR__ . "/../conf.php");
require(__DIR__ . "/../func.php");

class FuncTest extends TestCase
{
    public function fnCheckFileTypeDataProvider()
    {
        return [
            ['gif', true],
            ['pdf', false],
            ['jpg', true],
            ['png', true],
            ['exe', false],
            ['sh', false],
            ['php-x', false],
        ];
    }

    /**
     * @dataProvider fnCheckFileTypeDataProvider
     */
    public function testFnCheckFileType($extension, $expected)
    {
        $this->assertEquals($expected, fn_check_filetype($extension));
    }

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
    public function testFnGenerateFilename($ext, $name, $type = FILENAME_TYPE, $expected)
    {
        $this->assertEquals($expected, fn_generate_filename($ext, $name, $type));
    }

    public function fnSetNotificationDataProvider()
    {
        return [
            [
                'error',
                'message',
                [
                    'name' => 'ERROR',
                    'message' => 'message',
                ],
            ],
            [
                'warning',
                'message',
                [
                    'name' => 'WARNING',
                    'message' => 'message',
                ],
            ],
        ];
    }

    /**
     * @dataProvider fnSetNotificationDataProvider
     */
    public function testFnSetNotification($type, $message, $expected)
    {
        $this->assertEquals($expected, fn_set_notification($type, $message));
    }
}
