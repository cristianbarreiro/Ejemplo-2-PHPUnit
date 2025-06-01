<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    public function testCuandoLePaso3DevuelveFizz()
    {
        $fizzBuzz = new \App\FizzBuzz();
        $resultado = $fizzBuzz->diNumero(3);
        $this->assertEquals('Fizz', $resultado);
    }
}
