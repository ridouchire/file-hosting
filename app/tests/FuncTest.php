<?php

use PHPUnit\Framework\TestCase;

require(__DIR__ . "/../conf.php");
require(__DIR__ . "/../func.php");

class FuncTest extends TestCase
{

    public function setUp()
    {
        return;
    }

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
}
