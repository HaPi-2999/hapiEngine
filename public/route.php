<?php

use vendor\core\Router;

Router::add("post/qwe", "Auth\LoginController@index");
Router::add("", "App\MainController@index");

Router::add("test", "ButtonController@root");