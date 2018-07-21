<?php

use PHPUnit\Framework\TestCase;

require(__DIR__ . "/../../config.php");
require(__DIR__ . "/../functions/common.php");

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
                'name#53.jpg',
                'temp',
                'jpg',
                'FILENAME',
                'name53.jpg',
            ),
            array(
                'name',
                'temp',
                'png',
                'TEMP',
                'temp.png',
            ),
        );
    }

    /**
     * @dataProvider fnGenerateFilenameDataProvider
     */
    public function testFnGenerateFilename($name, $temp, $ext, $type = FILENAME_TYPE, $expected)
    {
        $this->assertEquals($expected, fn_generate_filename($name, $temp, $ext, $type));
    }
}
