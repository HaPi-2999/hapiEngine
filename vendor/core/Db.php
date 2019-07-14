<?php


namespace vendor\core;


use RedBeanPHP\R;

class Db extends R
{
    public function __construct()
    {
        if (!R::testConnection()) {
            R::setup('mysql:host='. DB_HOST .';dbname=' . DB, DB_USER, DB_PASSWORD);
            if (!R::testConnection()) {
                die("Нет подключения к базе данных");
            }
        }
    }
}