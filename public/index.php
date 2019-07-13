<?php

define("ROOT", dirname(__DIR__));// Корень
define("WWW", __DIR__); // папка с фалом index (public)
define("CORE",  dirname(__DIR__) . "vendor/core"); // Ядро(папка vendor)
define("APP", dirname(__DIR__) . "/app"); //mvs

require_once  "../vendor/include/global_functions.php";
require_once "route.php";

use vendor\core\Router;

Router::dispatch($_SERVER['REQUEST_URI']);