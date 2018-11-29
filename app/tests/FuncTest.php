<?php

namespace IHTests;

use PHPUnit\Framework\TestCase;

define('KERNEL', true);

require(__DIR__ . '/../conf.php');
require(__DIR__ . '/../func.php');

class FuncTest extends TestCase
{
    /**
     * dataprovider for testFnCheckFileType
     *
     * @return array
     */
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
     * Test for fn_check_filetype() function
     *
     * @param string  $extension Extension
     * @param boolean $expected  Expected
     * 
     * @dataProvider fnCheckFileTypeDataProvider
     *
     * @return void
     */
    public function testFnCheckFileType($extension, $expected)
    {
        $this->assertEquals($expected, fn_check_filetype($extension));
    }

    /**
     * dataprovider for generate filename test
     *
     * @return array
     */
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
     * Test generate filename
     *
     * @param string $ext      Extension
     * @param string $name     Filename
     * @param string $type     Filename type constant
     * @param mixed  $expected Expected
     * 
     * @dataProvider fnGenerateFilenameDataProvider
     *
     * @return void
     */
    public function testFnGenerateFilename($ext, $name, $type = FILENAME_TYPE, $expected)
    {
        $this->assertEquals($expected, fn_generate_filename($ext, $name, $type));
    }

    /**
     * dataprovider for notification test
     *
     * @return array
     */
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
     * Test notifications
     *
     * @param string $type     Notification type
     * @param string $message  Message text
     * @param array  $expected Expected
     * 
     * @dataProvider fnSetNotificationDataProvider
     *
     * @return void
     */
    public function testFnSetNotification($type, $message, $expected)
    {
        $this->assertEquals($expected, fn_set_notification($type, $message));
    }
}
