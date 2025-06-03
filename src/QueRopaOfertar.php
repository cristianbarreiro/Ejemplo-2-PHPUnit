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
        if (empty(trim($ciudad))) {
            throw new \InvalidArgumentException("La ciudad no puede estar vacía");
        }

        try {
            $temperatura = $this->api->queTemperaturaHaceEn($ciudad);

            // Chequea si temperatura tiene el valor especial para "sin datos"
            if ($temperatura === -999.0) {
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
