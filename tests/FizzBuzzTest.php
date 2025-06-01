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

    public function testCuandoLePaso5DevuelveBuzz()
    {
        $fizzBuzz = new \App\FizzBuzz();
        $resultado = $fizzBuzz->diNumero(5);
        $this->assertEquals('Buzz', $resultado);
    }

    public function testCuandoLePaso3y5DevuelveFizzBuzz()
    {
        $fizzBuzz = new \App\FizzBuzz();
        $resultado = $fizzBuzz->diNumero(15);
        $this->assertEquals('FizzBuzz', $resultado);
    }
}
