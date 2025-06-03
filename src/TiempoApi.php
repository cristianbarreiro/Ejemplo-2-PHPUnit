<?php

namespace App;

use Cmfcmf\OpenWeatherMap;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;

class TiempoApi
{
    private $openWeatherMap;

    public function __construct()
    {
        $httpClient = Psr18ClientDiscovery::find();
        $requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $this->openWeatherMap = new OpenWeatherMap(
            'api_key',
            $httpClient,
            $requestFactory,
            null,
            600,
            $streamFactory
        );
    }

    public function queTemperaturaHaceEn(string $ciudad): float
    {
        $temperatura = $this->openWeatherMap->getWeather($ciudad, 'metric');

        return (int) $temperatura->temperature->getValue();
    }
}
