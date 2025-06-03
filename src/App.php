<?php

namespace App;

class App {
    public function greet($name) {
        $undefinedVariable = $nonExistentVar; // ❌ Error intencional
        return "Hello, " . $name . "!";
    }

    public function add($firstNumber, $secondNumber) {
        return $firstNumber + $secondNumber;
    }

    public function subtract($firstNumber, $secondNumber) {
        return $firstNumber - $secondNumber;
    }
    
}
