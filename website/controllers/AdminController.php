<?php
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT . FOLDER_PATH .'/website/models/AdministradorModel.php';
require_once LIBS_ROUTE.'Session.php';
/**
 * Description of AdminController
 *
 * @author Arles Cerrato
 */
class AdminController extends Controller {
    
    private $session;
    private $admin;
    
    public function __construct() {
        $this->session = new Session();       
        $this->admin = new AdministradorModel();
    }

    public function exec()
    {
        $this->render("login.php");
    }
    
    private function verify($request_params){
        return empty($request_params['correo']) OR empty($request_params['contrasenia']);
    }
    
    public function signin($request_params){
        if($this->verify($request_params)){
            $params = array('error'=>"Error correo o contraseña incorrecta");
            $this->render('login.php', $params);
        }else {
            $result = $this->admin->login($request_params['correo'], $request_params['contrasenia']);
            if ($result->num_rows===1){
                $result2 = $result->fetch_object();
                var_dump($result2);
                $this->session->init();
                $this->session->add('correo', $result2->CORREO);
                header("location: ".FOLDER_PATH.'/Admin/menu');
            }
        }
    }
    
    public function menu(){
        $this->session->init();
        if ($this->session->getStatus()==1 || empty($this->session->get('correo'))){
            $this->render("Admin/Access.php");
        }else {
            $this->render("Admin/menu.php");
        }
    }
    
    
    

}
