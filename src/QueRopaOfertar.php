<?php

namespace App;

class QueRopaOfertar
{
    private TiempoApi $api;

    public function __construct(TiempoApi $api)
    {
        $this->api = $api;
    }

    public function determina(string $ciudad): string
    {
        try {
            $temperatura = $this->api->queTemperaturaHaceEn($ciudad);

            if ($temperatura === null) {
                return 'Datos insuficientes';
            }

            if ($temperatura > 18) {
                return 'Camisetas';
            } elseif ($temperatura >= 10 && $temperatura <= 18) {
                return 'Camisas';
            } else { // Menor que 10
                return 'Abrigos';
            }
        } catch (\Exception $e) {
            return 'Datos insuficientes';
        }
    }
}
