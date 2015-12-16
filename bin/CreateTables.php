<?php

$db = require __DIR__ . '/../app/db.php';

$sql = <<<EOT
CREATE TABLE sensordata(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    time TIMESTAMP UNIQUE DEFAULT CURRENT_TIMESTAMP,
    data_plain VARCHAR(32),
    gateway_eui VARCHAR(32),
    node_eui VARCHAR(8),
    CONSTRAINT prevent_duplicates UNIQUE (time, node_eui)
)
EOT;

$db->query('drop table if exists sensordata');

$db->query($sql);

$now = new DateTime;

#$randomNumbers = array_map(function ($n) {
#    return rand(0, 50);
#}, array_fill(0, 24, 0));

#foreach ($randomNumbers as $t) {
#    $now->add(new DateInterval("PT1H"));
#
#    try {
#        $db->query("insert into sensordata(time, data_plain) values('{$now->format(DateTime::ISO8601)}', '$t');");
#    } catch (\PDOException $e) {
#    }
#}
