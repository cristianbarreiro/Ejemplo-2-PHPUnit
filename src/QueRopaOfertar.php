<?php

namespace App;

class QueRopaOfertar
{
    private TiempoApi $api;

    public function __construct(TiempoApi $api)
    {
        $this->api = $api;
    }

    public function determina(string $city)
    {
        $temperatura = $this->api->queTemperaturaHaceEn($city);
        $categoria = 'Camisas';

        if ($temperatura > 18) {
            $categoria = 'Camisetas';
        } elseif ($temperatura < 10) {
            $categoria = 'Abrigos';
        }

        return $categoria;
    }
}