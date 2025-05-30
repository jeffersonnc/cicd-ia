<?php

class App {
    public function greet($name) {
        return "Hello, " . $name . "!";
    }

    public function add($firstNumber, $secondNumber) {
        return $firstNumber + $secondNumber;
    }

    public function subtract($firstNumber, $secondNumber) {
        return $firstNumber - $secondNumber;
    }
    
}