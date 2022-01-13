<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class ExampleAssertionsTest extends TestCase
{
    public function testIfProvidedDataMatches(): void
    {
        $string1 = 'testing';
        $string2 = 'testing';

        $string3 = 'Testing';

        $this->assertSame($string1, $string2);
    }


    public function testThatNumbersAddUp(): void
    {
        $this->assertEquals(16, 15 + 1);
    }


    /**
     * @test
     */
    public function doesTheStringStartWithHello(): void
    {
        $string1 = 'hello, I am Leon';
        $string2 = 'I am Leon';
        $this->assertStringStartsWith('hello', $string1);
    }


}