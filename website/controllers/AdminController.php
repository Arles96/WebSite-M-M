<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author Arles Cerrato
 */
class AdminController extends Controller {
    
    public function exec()
    {
        $this->render("login.php");
    }

}
