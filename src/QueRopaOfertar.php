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
            $temp = $this->api->queTemperaturaHaceEn($ciudad);
        } catch (\Exception $e) {
            return 'Datos insuficientes';
        }

        if (is_nan($temp)) {
            return 'Datos insuficientes';
        }

        if ($temp > 18) {
            return 'Camisetas';
        } elseif ($temp >= 10) {
            return 'Camisas';
        } else {
            return 'Abrigos';
        }
    }
}
