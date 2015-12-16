<?php

try {
    $db = new \PDO('sqlite:./database.db');
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo 'Error: ';
    echo $e->getMessage();
    die();
}

$sql = <<<EOT
CREATE TABLE sensordata(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_plain VARCHAR(32),
    gateway_eui VARCHAR(32),
    node_eui VARCHAR(8)
)
EOT;

$db->query('drop table sensordata');
$db->query($sql);
