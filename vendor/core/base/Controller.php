<?php


namespace vendor\core\base;


abstract class Controller
{
    protected $route = [];

    protected $view;

    protected $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = new Model();
    }

    protected function getView()
    {
        return $this->view;
    }
}