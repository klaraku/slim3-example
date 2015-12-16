<?php namespace trt\loraweather;

use PDO;

class SensorDataService
{
    private $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function all()
    {
        return $this->pdo->query('select * from sensordata')->fetchAll();
    }
}
