<?php


namespace vendor\core\base;


use RedBeanPHP\R;

class Model extends R
{
    public function __construct()
    {
        R::setup('mysql:host=localhost;dbname=' . DB, DB_USER, DB_PASSWORD);
        if (!R::testConnection()) {
            die("Нет подключения к базе данных");
        }
    }
}