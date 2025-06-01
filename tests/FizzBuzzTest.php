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
}
