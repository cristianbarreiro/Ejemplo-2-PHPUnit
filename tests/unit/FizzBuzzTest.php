<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use App\FizzBuzz;

#[CoversClass(FizzBuzz::class)] // Indicamos que este test cubre la clase FizzBuzz
class FizzBuzzTest extends TestCase
{
    public static function casosDeUso(): array
    {
        return [
            [3, 'Fizz'],
            [5, 'Buzz'],
            [15, 'FizzBuzz'],
            [1, '1']
        ];
    }

    #[DataProvider('casosDeUso')]
    public function testParaFizzBuzz($numeroATestear, $resultadoEsperado)
    {
        $fizzBuzz = new FizzBuzz();
        $resultado = $fizzBuzz->diNumero($numeroATestear);
        $this->assertEquals($resultadoEsperado, $resultado);
    }

    public function testLaCuentaEsCeroSiNadieHaDichoNada()
    {
        $fizzBuzz = new FizzBuzz();
        $this->assertEquals(0, $fizzBuzz->dimeLaCuenta());
    }

    public function testLaCuentaSeIncrementaCuandoDecimosNumero()
    {
        $fizzBuzz = new FizzBuzz();
        $fizzBuzz->diNumero(1);
        // $this->assertEquals(1, $fizzBuzz->dimeLaCuenta());

        $fizzBuzz->diNumero(2);
        $this->assertEquals(2, $fizzBuzz->dimeLaCuenta());

        // $fizzBuzz->diNumero(3);
        // $this->assertEquals(3, $fizzBuzz->dimeLaCuenta());
    }
}
