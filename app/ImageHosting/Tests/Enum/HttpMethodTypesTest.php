<?php

namespace IH\Tests;
use IH\Enum\HttpMethodTypes;
use PHPUnit\Framework\TestCase;

class HttpMethodTypesTest extends TestCase
{
    /**
     * @dataProvider dpTestGetAll
     */
    public function testGetAll($expected)
    {
        $this->assertEquals($expected, HttpMethodTypes::getAll());
    }

    public function dpTestGetAll()
    {
        return array(
            array(
                array(
                    'POST',
                    'GET'
                )
            )
        );
    }
}
