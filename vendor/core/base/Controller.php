<?php


namespace vendor\core\base;


use vendor\core\Db;

abstract class Controller
{
    protected $route = [];

    protected $view;

    protected $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = new Db();
    }

    protected function getView()
    {
        return $this->view;
    }

    public function getModel()
    {
        return $this->model;
    }
}