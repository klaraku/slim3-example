<?php namespace trt\lora;

use Slim\Views\Twig;

class SensorController
{
    private $view;
    private $service;

    function __construct(Twig $view, SensorDataRepository $repository)
    {
        $this->view = $view;
        $this->repository = $repository;
    }

    function temperature($req, $res)
    {
        $allSensorData = $this->repository->findByNodeId('02031001');

        $this->view->render($res, 'temperature.twig', [
            'sensordata' => $allSensorData,
        ]);
    }

    function motion($req, $res)
    {
        $sensorData = $this->repository->findByNodeId('02031002');

        $this->view->render($res, 'motion.twig', [
            'title' => 'PIR motion detection',
            'sensordata' => $sensorData,
        ]);
    }

    function motionrpi($req, $res)
    {
        $this->view->render($res, 'motionrpi.twig');
    }
}
