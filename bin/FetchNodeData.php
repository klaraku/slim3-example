<?php namespace trt\lora;

use PDO;
use DateTime;
use DateInterval;

require __DIR__ . '/../vendor/autoload.php';

$db = require __DIR__ . '/../app/db.php';
$repository = new SensorDataRepository($db);

$nodes = [
    '02031001',
    '02031002',
];

$feed = 'http://thethingsnetwork.org/api/v0/nodes/%s/?limit=5';


foreach ($nodes as $node) {
    $json = file_get_contents(sprintf($feed, $node));
    $data = json_decode($json, true);

    usort($data, function ($a, $b) {
        $time1 = new DateTime($a['time']);
        $time2 = new DateTime($b['time']);

        return $time1 > $time2;
    });

    foreach ($data as $nodeData) {
        $repository->save($nodeData);
    }
}
