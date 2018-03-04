<?php

defined('BASEPATH') or exit('No se permite el acceso');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorPageController
 *
 * @author Arles Cerrato
 */
class ErrorPageController extends Controller {
    
    
    /*
     * Se ejecuta la plantilla de Error
     */
    public function exec()
    {
        $this->render("Error");
    }

}
