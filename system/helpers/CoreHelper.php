<?php

/**
 *Esta clase ayuda a verificar si existe el controllador
 *
 * @author Arles Cerrato
 */
class CoreHelper {
    
    /*
     * Funcion para saber si el controlador existe
     * @var string $controller
     */
    public static function validateController($controller){
        if(!is_file(PATH_CONTROLLERS."{$controller}Controller.php")){
            return false;
        }
        return true;
    }
    
    /*
     * Funcion para saber si el metodo existe
     * @var string controller
     * @var string method
     */
    public static function validateMethodController($controller, $method){
        if (!method_exists($controller, $method)){
            return false;
        }
        return true;    
    }
    
}
