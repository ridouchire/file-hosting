<?php

namespace IH\Tests;
use IH\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    /**
     * @dataProvider dpTestGetFalse
     */
    public function testGetFalse($key, $expected)
    {
        App::set('one', 1);
        $this->assertEquals($expected, App::get($key));
    }

    public function dpTestGetFalse()
    {
        return array(
            array(
                'one',
                1,
            )
        );
    }
}
