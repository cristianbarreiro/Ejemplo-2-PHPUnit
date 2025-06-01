<?php

namespace App;

class FizzBuzz {
    public function diNumero(int $numero): string
    {
        if ($numero % 3 === 0 && $numero % 5 === 0) {
            return 'FizzBuzz';
        } elseif ($numero % 3 === 0) {
            return 'Fizz';
        } elseif ($numero % 5 === 0) {
            return 'Buzz';
        } else {
            return (string)$numero;
        }
    }
}