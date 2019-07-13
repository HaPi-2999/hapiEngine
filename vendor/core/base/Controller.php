<?php


namespace vendor\core\base;


abstract class Controller
{
    protected $route = [];

    protected $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }

    protected function getView()
    {
        return $this->view;
    }
}