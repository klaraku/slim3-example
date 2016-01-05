<?php

$app->get('/', 'trt\lora\MainController:index');
$app->get('/temperature', 'trt\lora\SensorController:temperature')->setName('temperature');
$app->get('/motion-detection', 'trt\lora\SensorController:motion')->setName('motion');
$app->get('/motion-detection/rpi', 'trt\lora\SensorController:motionrpi')->setName('motion_rpi');
$app->get('/api/node/{node}', 'trt\lora\ApiController:node');
