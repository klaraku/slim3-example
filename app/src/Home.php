<?php namespace trt\loraweather;

use Slim\Views\Twig;

class Home
{
    private $view;
    private $service;

    function __construct(Twig $view, SensorDataService $service)
    {
        $this->view = $view;
        $this->service = $service;
    }

    function index($req, $res)
    {
        $allSensorData = $this->service->all();

        $this->view->render($res, 'index.twig', [
            'sensordata' => $allSensorData,
        ]);
    }
}
