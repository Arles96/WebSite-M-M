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

$controller =  $router->getController();
$method = $router->getMethod();
$param = $router->getParam();



