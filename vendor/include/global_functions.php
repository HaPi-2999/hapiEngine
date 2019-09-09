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

/**
 * @param $name
 * @return null|string
 * Возврашает путь к файлу по формату
 */
function assets($name) {
    $format = array_reverse(explode(".", $name))[0];

    if ($format === "js") {
        return "public/js/$name";
    } elseif ($format === "css") {
        return "public/css/$name";
    } else {
        return "public/img/$name";
    }



    return null;
}