<?php

use vendor\core\Router;

Router::add("home", "MainController@index");

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    //REQUEST METHOD GET

    Router::add('add.users', 'UserController@getPage');



} elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
    //REQUEST METHOD POST
    Router::add('add.users', 'UserController@addUsers');
}