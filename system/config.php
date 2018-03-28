<?php

defined('BASEPATH') or exit('No se permite el acceso');

/*
 * VALORES DE URI
 */
define('URI', $_SERVER['REQUEST_URI']);
define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);

/*
 * Reglas de Rutas
 */
define('FOLDER_PATH', '/WebSite-M-M');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PATH_VIEWS', FOLDER_PATH.'/website/views/');
define('PATH_CONTROLLERS', 'website/controllers/');
define('HELPER_PATH', '/system/helpers');
define('LIBS_ROUTE', ROOT.FOLDER_PATH.'/system/libs/');

/**
 * Ruta para las imagenes
 */
define('PATH_IMG', './public/img/');

/*
 * Valores de Core
 */
define('CORE', 'system/core/');
define('DEFAULT_CONTROLLER', 'Inicio');

/*
 * Valores de base de  datos 
 */
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB_NAME', 'website_mm');

/*
 * Valores de configuración
 */
define('ERROR_REPORTING_LEVEL', -1);