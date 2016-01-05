<?php namespace trt\lora;

use Slim\Views\Twig;

class ApiController
{
    private $service;

    function __construct(SensorDataRepository $repository)
    {
        $this->repository = $repository;
    }

    function node($req, $res)
    {
        $node = $req->getAttribute('node');

        $sensorData = $this->repository->findByNodeId($node);

        $newReponse = $res->withHeader('Content-Type', 'application/json');
        $newReponse->getBody()->write(json_encode($sensorData));

        return $newReponse;
    }
}
