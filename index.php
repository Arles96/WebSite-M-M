<?php

define('BASEPATH', true);

require 'system/config.php';

require 'system/core/autoload.php';

/*
 * Nivel de errores notificados
 */
error_reporting(ERROR_REPORTING_LEVEL);

/*
 * Inicializa la URI
 */
$router = new Router();
$controller2 =  $router->getController();
$method = $router->getMethod();
$param = $router->getParam();

/*
 * Validaciones del controlador y del metodo
 */
require 'system/helpers/CoreHelper.php';

if (!CoreHelper::validateController($controller2))
{
    $controller2 = "ErrorPage";
}

require PATH_CONTROLLERS."{$controller2}Controller.php";

$controller2 .= 'Controller';

if (!CoreHelper::validateMethodController($controller2, $method))
{
    $method = "exec";
}

/*
 * Ejecucion final del controlador, metodo y párametro obtenido por URI
 */
$controller = new $controller2();
$controller->$method($param);