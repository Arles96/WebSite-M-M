<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InicioController
 *
 * @author Arles Cerrato
 */
class InicioController extends Controller{
    //put your code here
    
    public function __construct()
    {
        
    }
    
    
    public function exec()
    {
        $this->render("Inicio");
    }

}
