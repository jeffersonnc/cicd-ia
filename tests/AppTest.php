<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\App; // Adjust the namespace according to your project structure
// Assuming the App class is in the App namespace and located in src/App.php

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
}
