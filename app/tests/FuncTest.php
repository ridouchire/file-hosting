<?php

use PHPUnit\Framework\TestCase;

define('KERNEL', true);

require(__DIR__ . "/../conf.php");
require(__DIR__ . "/../func.php");

class FuncTest extends TestCase
{
    public function fnCheckFileTypeDataProvider()
    {
        return array(
            array('gif', true),
            array('pdf', false),
            array('jpg', true),
            array('png', true),
            array('exe', false),
            array('sh', false),
            array('php-x', false),
        );
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
        return array(
            array(
                'jpg',
                'name#53.jpg',
                'FILENAME',
                'name53.jpg',
            ),
            array(
                'png',
                'temp',
                'TEMP',
                'temp.png',
            ),
            array(
                'png',
                null,
                'TEMP',
                false,
            ),
            array(
                'jpg',
                null,
                'FILENAME',
                false,
            )
        );
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
        return array(
            array(
                'error',
                'message',
                array(
                    'name' => 'Error',
                    'message' => 'message',
                ),
            ),
            array(
                'warning',
                'message',
                array(
                    'name' => 'Warning',
                    'message' => 'message',
                ),
            ),
        );
    }

    /**
     * @dataProvider fnSetNotificationDataProvider
     */
    public function testFnSetNotification($type, $message, $expected)
    {
        $this->assertEquals($expected, fn_set_notification($type, $message));
    }
}
