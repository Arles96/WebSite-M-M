<?php

defined('BASEPATH') or exit('No se permite el acceso');

/**
 * Clase padre que se utilizara para controlar las datos y las vistas del sitio web
 *
 * @author Arles Cerrato
 */
abstract class Controller {
    
    /*
     * @var Objeto
     */
    private $view;
    
    /*
     * Inicializa o renderiza la vista. 
     * @var string template. 
     * @var array params. Opcional
     */
    public function render($template = '' , $params = array() ){
        $this->view = new View($template, $params); 
    }
    
    /*
     * Metodo estandar. Se ejecuta automaticamente si no se define el metodo en la url
     */
    abstract public function exec();
    
}
