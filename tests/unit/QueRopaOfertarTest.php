<?php

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use App\QueRopaOfertar;
use App\TiempoApi;
use PHPUnit\Framework\MockObject\MockObject;

#[CoversClass(QueRopaOfertar::class)]
class QueRopaOfertarTest extends TestCase
{
    /** @var TiempoApi&MockObject */
    private TiempoApi $tiempoApi;
    private QueRopaOfertar $queRopaOfertar;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tiempoApi = $this->createMock(TiempoApi::class);
        $this->queRopaOfertar = new QueRopaOfertar($this->tiempoApi);
    }

    public function testDeterminaCamisetasCuandoHaceMasDe18Grados()
    {
        $this->tiempoApi->method('queTemperaturaHaceEn')->willReturn(25.0);
        $this->assertEquals('Camisetas', $this->queRopaOfertar->determina('Madrid'));
    }

    public function testDeterminaCamisasCuandoHaceEntre10y18Grados()
    {
        $this->tiempoApi->method('queTemperaturaHaceEn')->willReturn(15.0);
        $this->assertEquals('Camisas', $this->queRopaOfertar->determina('Madrid'));
    }

    public function testDeterminaAbrigosCuandoHaceMenosDe10Grados()
    {
        $this->tiempoApi->method('queTemperaturaHaceEn')->willReturn(5.0);
        $this->assertEquals('Abrigos', $this->queRopaOfertar->determina('Madrid'));
    }

    public function testDeterminaCamisasCuandoHaceExactamente10Grados()
    {
        $this->tiempoApi->method('queTemperaturaHaceEn')->willReturn(10.0);
        $this->assertEquals('Camisas', $this->queRopaOfertar->determina('Madrid'));
    }

    public function testDeterminaCamisasCuandoHaceExactamente18Grados()
    {
        $this->tiempoApi->method('queTemperaturaHaceEn')->willReturn(18.0);
        $this->assertEquals('Camisas', $this->queRopaOfertar->determina('Madrid'));
    }

    public function testDeterminaAbrigosCuandoHaceTemperaturaNegativa()
    {
        $this->tiempoApi->method('queTemperaturaHaceEn')->willReturn(-5.0);
        $this->assertEquals('Abrigos', $this->queRopaOfertar->determina('Madrid'));
    }

    public function testDeterminaCamisetasCuandoHaceTemperaturaMuyAlta()
    {
        $this->tiempoApi->method('queTemperaturaHaceEn')->willReturn(45.0);
        $this->assertEquals('Camisetas', $this->queRopaOfertar->determina('Madrid'));
    }

    public function testDeterminaConTemperaturaNula()
    {
        $this->tiempoApi->method('queTemperaturaHaceEn')->willReturn(-999.0);
        $this->assertEquals('Datos insuficientes', $this->queRopaOfertar->determina('Madrid'));
    }

    public function testDeterminaCuandoLaApiLanzaExcepcion()
    {
        $this->tiempoApi->method('queTemperaturaHaceEn')->will($this->throwException(new \Exception("API no responde")));
        $this->assertEquals('Datos insuficientes', $this->queRopaOfertar->determina('Madrid'));
    }

    public function testDeterminaLanzaExcepcionCuandoCiudadVacia()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->queRopaOfertar->determina('');
    }
}
