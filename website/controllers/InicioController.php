<?php

defined('BASEPATH') or exit('No se permite el acceso');
/**
 * Description of InicioController
 *
 * @author Arles Cerrato
 */
class InicioController extends Controller{   
    
    /*
     * Contructor de la clase InicioController
     */
    public function __construct()
    {
        
    }
    
    /*
     * Se renderiza la plantilla inicio
     */
    public function exec()
    {
        $this->render("Inicio");
    }

}