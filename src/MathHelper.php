<?php

namespace App;

class MathHelper
{
    public function factorial(int $n): int
    {
        if ($n < 0) {
            throw new \InvalidArgumentException("Factorial no válido para números negativos");
        }
        
        if ($n === 0 || $n === 1) {
            return 1;
        }
        
        $result = 1;
        for ($i = 2; $i <= $n; $i++) {
            $result *= $i;
        }
        
        return $result;
    }
    
    public function isPrime(int $n): bool
    {
        if ($n < 2) {
            return false;
        }
        
        if ($n === 2) {
            return true;
        }
        
        if ($n % 2 === 0) {
            return false;
        }
        
        for ($i = 3; $i * $i <= $n; $i += 2) {
            if ($n % $i === 0) {
                return false;
            }
        }
        
        return true;
    }
    
    public function fibonacci(int $n): array
    {
        if ($n <= 0) {
            return [];
        }
        
        if ($n === 1) {
            return [0];
        }
        
        $sequence = [0, 1];
        for ($i = 2; $i < $n; $i++) {
            $sequence[] = $sequence[$i - 1] + $sequence[$i - 2];
        }
        
        return $sequence;
    }
}