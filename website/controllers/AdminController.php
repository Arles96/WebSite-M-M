<?php

require_once LIBS_ROUTE.'Session.php';
require_once ROOT.FOLDER_PATH."/website/models/AdministradorModel";
/**
 * Description of AdminController
 *
 * @author Arles Cerrato
 */
class AdminController extends Controller {
    
    private $session;
    private $admin;

    public function exec()
    {
        $this->render("login.php");
        $session = new Session();       
        $admin = new AdministradorModel();
    }
    
    public function signin($request_params){
        if(verify($request_params)){
            $params = array('error'=>"Error correo o contraseña incorrecta");
            $this->render('login.php', $params);
        }else {
            $result = $this->admin->login($request_params['correo'], $request_params['contrasenia']);
            if ($result->num_rows==1){
                $result2 = $result->fetch_object();
                $this->session->init();
                echo $result2->correo;
                $this->session->add('correo', $result2->correo);
            }
        }
    }
    
    private function verify($request_params){
        return empty($request_params['correo']) OR empty($request_params['contrasenia']);
    }
    

}
