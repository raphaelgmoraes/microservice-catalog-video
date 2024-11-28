<?php

namespace Tests\Unit;

use Core\TestClass;
use PHPUnit\Framework\TestCase;

class TestClassUnitTest extends TestCase
{
    public function test_call_method_foo()
    {
        $class = new TestClass();
        $response = $class->foo();
        $this->assertEquals('foo', $response);
    }
    public function test_call_method_bar()
    {
        $class = new TestClass();
        $this->assertEquals('bar', $class->bar());
    }
}