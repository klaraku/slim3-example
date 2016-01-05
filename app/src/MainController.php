<?php namespace trt\lora;

use Slim\Views\Twig;

class MainController
{
    private $view;

    function __construct(Twig $view)
    {
        $this->view = $view;
    }

    function index($req, $res)
    {
        $this->view->render($res, 'index.twig', [
            'title' => 'Welcome!',
        ]);
    }
}
