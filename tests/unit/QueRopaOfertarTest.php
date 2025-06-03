<?php

use PHPUnit\Framework\TestCase;
use App\QueRopaOfertar;
use App\TiempoApi;

class QueRopaOfertarTest extends TestCase
{
    public function testDeterminaCamisetasCuandoHaceMasDe18Grados()
    {
        // Creamos un mock de TiempoApi
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(25.0);

        $ropa = new QueRopaOfertar($apiMock);
        $resultado = $ropa->determina('Madrid');

        $this->assertEquals('Camisetas', $resultado);
    }

    public function testDeterminaCamisasCuandoHaceEntre10y18Grados()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(15.0);

        $ropa = new QueRopaOfertar($apiMock);
        $resultado = $ropa->determina('Madrid');

        $this->assertEquals('Camisas', $resultado);
    }

    public function testDeterminaAbrigosCuandoHaceMenosDe10Grados()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(5.0);

        $ropa = new QueRopaOfertar($apiMock);
        $resultado = $ropa->determina('Madrid');

        $this->assertEquals('Abrigos', $resultado);
    }
}
