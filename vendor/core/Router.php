<?php
namespace vendor\core;


class Router
{
    protected static $routes = [];
    protected static $route = [];

    /**
     * @param $uri uri странницы
     * @param $actionString строка показывающая класс и метод которые будут выполняться
     */
    public static function add($uri, $actionString)
    {
        $uri = self::checkUri($uri);
        self::$routes[$uri] = self::formatActionString($actionString);

    }

    /**
     * @return array возвращает все роуты сайта
     */
    protected static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * @return array возвращает активный роут сайта
     */
    protected static function getRoute()
    {
        return self::$route;
    }

    /**
     * @param $string
     * @return array consisting of name Class and name Method
     */
    private static function formatActionString($string)
    {
        $array = explode("@", $string);
        return $array;
    }

    /**
     * провекра наличия страницы сайта на сервере
     * @param $uri
     * @return string
     */
    private static function matchRoute($uri)
    {
        $uri = self::checkUri($uri);

        foreach (self::$routes as $k => $route) {
            if ($k === $uri) {
                self::$route = $route;
                return true;
            }
        }
        require_once WWW . "/404.php";

        return false;
    }

    /**
     * Проверят есть ли класс и метод и если есть вызывает его
     * @param $url
     */
    public static function dispatch($url)
    {
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::getRoute()[0];
            $method = self::getRoute()[1];

            if (class_exists($controller)) {
                $cont = new $controller(self::getRoute());
                if (method_exists($cont, $method)) {
                    $cont->$method();
                } else {
                    echo "Method $method not found in controller $controller";
                }
            } else {
                echo "Controller $controller not found on server";
            }
        } else {
        }
    }

    private static function trimUri($uri)
    {
        if ($uri[0] === "/") {
            $uri = ltrim($uri, "/");
        }
        if ($uri[strlen($uri) - 1] === "/") {
            $uri = rtrim($uri, "/");
        }
        return $uri;
    }

    /**
     * Удаляет начальны и коннечные слеши с uri
     * @param $uri
     * @return string
     */
    private static function checkUri($uri)
    {
        if ($uri === '' || $uri === '/') {
            $uri = "/";
            return $uri;
        }
        return self::trimUri($uri);
    }

    public static function deleteGetParam($uri)
    {
        return explode("?", $uri)[0];
    }

}