<?php namespace trt\lora;

use PDO;

$container = $app->getContainer();

$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig(
        $c['settings']['view']['template_path']
    );

    $view->addExtension(new \Slim\Views\TwigExtension(
        $c->get('router'),
        $c->get('request')->getUri()
    ));

    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

$container['pdo'] = function ($c) {
    return require __DIR__ . '/db.php';
};

$container['trt\lora\SensorDataRepository'] = function ($c) {
    return new SensorDataRepository(
        $c['pdo']
    );
};

$container['trt\lora\MainController'] = function ($c) {
    return new MainController(
        $c['view']
    );
};

$container['trt\lora\SensorController'] = function ($c) {
    return new SensorController(
        $c['view'],
        $c['trt\lora\SensorDataRepository']
    );
};

$container['trt\lora\ApiController'] = function ($c) {
    return new ApiController(
        $c['trt\lora\SensorDataRepository']
    );
};
