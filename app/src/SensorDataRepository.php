<?php namespace trt\lora;

use PDO;
use DateTime;
use Slim\Views\Twig;

class SensorDataRepository
{
    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function findByNodeId($node)
    {
        $sql = 'select * from sensordata where node_eui = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$node]);

        return $stmt->fetchAll();
    }

    function save(array $nodeData)
    {
        $sql = "
            INSERT INTO sensordata(time, data_plain, gateway_eui, node_eui)
            VALUES(?, ?, ?, ?)
        ";

        $stmt = $this->pdo->prepare($sql);

        $time = new DateTime($nodeData['time']);

        try {
            $stmt->execute([
                $time->format(DateTime::ISO8601),
                $nodeData['data_plain'],
                $nodeData['gateway_eui'],
                $nodeData['node_eui'],
            ]);
        } catch (\PDOException $e) {
            print 'Skipped duplicate.' . PHP_EOL;
        }
    }
}
