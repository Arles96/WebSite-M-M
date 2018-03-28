<?php

class publicController extends Controller {
    
    public function __construct()
    {
        
    }
    
    public function css($param){
        if (empty($param)) {
            $this->render('Error.php');
        }else {
            $this->render("public/css/".$param);
        }
    }
    
    public function img($param){
        if (empty($param)){
            $this->render("Error.php");
        }else {
            $this->render("public/img/$param");
        }
    }


    public function exec()
    {
        
    }

}
