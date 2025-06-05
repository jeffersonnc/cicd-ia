<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\MathHelper;

class MathHelperTest extends TestCase
{
    private MathHelper $mathHelper;

    protected function setUp(): void
    {
        $this->mathHelper = new MathHelper();
    }

    public function testFactorialZero(): void
    {
        $this->assertEquals(1, $this->mathHelper->factorial(0));
    }

    public function testFactorialOne(): void
    {
        $this->assertEquals(1, $this->mathHelper->factorial(1));
    }

    public function testFactorialPositive(): void
    {
        $this->assertEquals(120, $this->mathHelper->factorial(5));
        $this->assertEquals(720, $this->mathHelper->factorial(6));
    }

    public function testFactorialNegative(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->mathHelper->factorial(-1);
    }

    public function testIsPrimeSmallNumbers(): void
    {
        $this->assertFalse($this->mathHelper->isPrime(0));
        $this->assertFalse($this->mathHelper->isPrime(1));
        $this->assertTrue($this->mathHelper->isPrime(2));
        $this->assertTrue($this->mathHelper->isPrime(3));
        $this->assertFalse($this->mathHelper->isPrime(4));
    }

    public function testIsPrimeLargerNumbers(): void
    {
        $this->assertTrue($this->mathHelper->isPrime(17));
        $this->assertTrue($this->mathHelper->isPrime(29));
        $this->assertFalse($this->mathHelper->isPrime(25));
        $this->assertFalse($this->mathHelper->isPrime(100));
    }

    public function testFibonacciEmpty(): void
    {
        $this->assertEquals([], $this->mathHelper->fibonacci(0));
        $this->assertEquals([], $this->mathHelper->fibonacci(-1));
    }

    public function testFibonacciOne(): void
    {
        $this->assertEquals([0], $this->mathHelper->fibonacci(1));
    }

    public function testFibonacciSequence(): void
    {
        $this->assertEquals([0, 1], $this->mathHelper->fibonacci(2));
        $this->assertEquals([0, 1, 1, 2, 3], $this->mathHelper->fibonacci(5));
        $this->assertEquals([0, 1, 1, 2, 3, 5, 8, 13], $this->mathHelper->fibonacci(8));
    }
}