<?php

$app->get('/', 'trt\loraweather\Home:index');
$app->get('/api/all', 'trt\loraweather\ApiController:all');
