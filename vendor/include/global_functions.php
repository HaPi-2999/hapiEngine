<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.07.19
 * Time: 9:24
 */

/**
 * autoload
 */
spl_autoload_register(function($file) {
    $file = ROOT . "/" .str_replace("\\","/",$file) . ".php";
    if  (is_file($file)) {
        require_once $file;
    }
});

/**
 * @param $var
 * @return string
 * Вывод данных  на экран в нормальном виде
 */
function debug($var) {
    echo "<pre>" . print_r($var, true) . "</pre>";
}

