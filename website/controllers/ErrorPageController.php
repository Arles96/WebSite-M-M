<?php

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
    //put your code here
    public function exec()
    {
        $this->render("Error");
    }

}
