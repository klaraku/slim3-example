<?php namespace trt\loraweather;

use Slim\Views\Twig;

class ApiController
{
    private $service;

    function __construct(SensorDataService $service)
    {
        $this->service = $service;
    }

    function all($req, $res)
    {
        $allSensorData = $this->service->all();

        $newReponse = $res->withHeader('Content-Type', 'application/json');
        $newReponse->getBody()->write(json_encode($allSensorData));

        return $newReponse;
    }
}
