<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/App.php';

class AppTest extends TestCase
{
    private $app;

    protected function setUp(): void
    {
        $this->app = new App();
    }
    
    public function testGreet()
    {
        $this->assertEquals('Hello, Jeff!', $this->app->greet('Jeff'));
    }

    public function testAdd()
    {
        $this->assertEquals(5, $this->app->add(2, 3));
    }

    public function testSubtract()
    {
        $this->assertEquals(1, $this->app->subtract(3, 2));
    }

    // Add more tests for other methods in the App class
}