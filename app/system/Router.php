<?php
namespace GymSolution\System;

use GymSolution\Controllers\Main;
use Exception;

class Router
{
    public static function dispatch()
    {
        // main route values
        $httpverb = $_SERVER['REQUEST_METHOD'];
        $controller = 'main';
        $method = 'index';

        // check uri parameters
        if (isset($_GET['ct'])) {
            $controller = $_GET['ct'];
        }

        if (isset($_GET['mt'])) {
            $method = $_GET['mt'];
        }

        // method parameters
        $parameters = $_GET;

        // remove controller from parameters
        if (key_exists("ct", $parameters)) {
            unset($parameters["ct"]);
        }

        // remove method from parameters
        if (key_exists("mt", $parameters)) {
            unset($parameters["mt"]);
        }

        // Check if 'id' is present and is the last parameter
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        // tries to instantiate the controller and execute the method
        try {
            $class = "GymSolution\Controllers\\$controller";
            $controllerInstance = new $class();
        
            // Verifica se 'id' está presente nos parâmetros
            if (isset($parameters['id'])) {
                $controllerInstance->$method($parameters['id']);
            } else {
                $controllerInstance->$method(...$parameters);
            }
        } catch (\Throwable $th) {
            $_SESSION['router'] = $th;
            $controller = new \GymSolution\Controllers\Main(); // Instancia o controlador Main
            $controller->acesso_negado($th->getMessage()); // Chama a função acesso_negado
            exit();
        }
    }
}
