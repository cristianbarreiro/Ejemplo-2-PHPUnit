<?php

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use App\QueRopaOfertar;
use App\TiempoApi;

#[CoversClass(QueRopaOfertar::class)]
class QueRopaOfertarTest extends TestCase
{
    public function testDeterminaCamisetasCuandoHaceMasDe18Grados()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(25.0);

        $ropa = new QueRopaOfertar($apiMock);
        $this->assertEquals('Camisetas', $ropa->determina('Madrid'));
    }

    public function testDeterminaCamisasCuandoHaceEntre10y18Grados()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(15.0);

        $ropa = new QueRopaOfertar($apiMock);
        $this->assertEquals('Camisas', $ropa->determina('Madrid'));
    }

    public function testDeterminaAbrigosCuandoHaceMenosDe10Grados()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(5.0);

        $ropa = new QueRopaOfertar($apiMock);
        $this->assertEquals('Abrigos', $ropa->determina('Madrid'));
    }

    // CASOS LÍMITE -----------------------------------

    public function testDeterminaCamisasCuandoHaceExactamente10Grados()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(10.0);

        $ropa = new QueRopaOfertar($apiMock);
        $this->assertEquals('Camisas', $ropa->determina('Madrid'));
    }

    public function testDeterminaCamisasCuandoHaceExactamente18Grados()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(18.0);

        $ropa = new QueRopaOfertar($apiMock);
        $this->assertEquals('Camisas', $ropa->determina('Madrid'));
    }

    // VALORES EXTREMOS --------------------------------

    public function testDeterminaAbrigosCuandoHaceTemperaturaNegativa()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(-5.0);

        $ropa = new QueRopaOfertar($apiMock);
        $this->assertEquals('Abrigos', $ropa->determina('Madrid'));
    }

    public function testDeterminaCamisetasCuandoHaceTemperaturaMuyAlta()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(45.0);

        $ropa = new QueRopaOfertar($apiMock);
        $this->assertEquals('Camisetas', $ropa->determina('Madrid'));
    }

    // MANEJO DE ERRORES --------------------------------

    public function testDeterminaConTemperaturaNula()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->willReturn(-999.0);

        $ropa = new QueRopaOfertar($apiMock);
        $this->assertEquals('Datos insuficientes', $ropa->determina('Madrid'));
    }


    public function testDeterminaCuandoLaApiLanzaExcepcion()
    {
        $apiMock = $this->createMock(TiempoApi::class);
        $apiMock->method('queTemperaturaHaceEn')->will($this->throwException(new \Exception("API no responde")));

        $ropa = new QueRopaOfertar($apiMock);
        $this->assertEquals('Datos insuficientes', $ropa->determina('Madrid'));
    }

    public function testDeterminaLanzaExcepcionCuandoCiudadVacia()
    {
        $this->expectException(\InvalidArgumentException::class);

        $apiMock = $this->createMock(TiempoApi::class);
        $ropa = new QueRopaOfertar($apiMock);

        $ropa->determina('');
    }
}
