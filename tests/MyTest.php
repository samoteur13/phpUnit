<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    public function testAddition()
    {
        $result = 1 + 2;
        static::assertEquals(3, $result);
    }
}
