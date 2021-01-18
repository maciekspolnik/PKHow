<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/ProjectController.php';

class Router{
    public static $routes;

    public static function get($url, $controller)
    {
        self::$routes[$url] = $controller;
    }
    public static function post($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function run($url)
    {
        $action = explode("/",$url)[0];
        if(!array_key_exists($action, self::$routes))
        {
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $controller = self::$routes[$action];

        $object->$action();
    }
}