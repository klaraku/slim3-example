<?php


try {
    $db = new \PDO('sqlite:' . __DIR__ . '/../../lora-weather-appdata/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(Exception $e) {
    echo 'Error: ';
    echo $e->getMessage();
    die();
}

return $db;
