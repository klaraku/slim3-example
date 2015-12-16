<?php namespace trt\loraweather;

use PDO;
use DateTime;
use DateInterval;

$nodes = [
    '02031001',
];

$feed = 'http://thethingsnetwork.org/api/v0/nodes/%s/?limit=10';

$json = file_get_contents(sprintf($feed, $nodes[0]));
$data = json_decode($json, true);

try {
    $db = new PDO('sqlite:' . __DIR__ . '/../database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo 'Error: ';
    echo $e->getMessage();
    die();
}

usort($data, function ($a, $b) {
    $time1 = new DateTime($a['time']);
    $time2 = new DateTime($b['time']);

    return $time1 > $time2;
});

foreach ($data as $nodeData) {
    $stmt = $db->prepare("INSERT INTO sensordata(time, data_plain, gateway_eui, node_eui) VALUES(?, ?, ?, ?)");

    $time = new DateTime($nodeData['time']);
    #$time->add(new DateInterval('PT1H'));

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
