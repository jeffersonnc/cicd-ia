<?php

class App {
    public function greet($name) {
        return "Hello, " . $name . "!";
    }

    public function add($FirstNumber, $SecondNumber) {
        return $FirstNumber + $SecondNumber;
    }

    public function subtract($FirstNumber, $SecondNumber) {
        return $FirstNumber - $SecondNumber;
    }
    
}