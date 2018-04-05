<?php

require_once ROOT . FOLDER_PATH .'/website/models/PublicidadModel.php';
require_once LIBS_ROUTE.'Session.php';

/**
 * Description of PublicidadController
 *
 * @author Arles Cerrato
 */
class PublicidadController extends Controller{
    
    private $session;
    private $publicidad;
    
    public function  __construct()
    {
        $this->session = new Session();
        $this->publicidad = new PublicidadModel();
    }


    public function exec()
    {
        if($this->verifySession()){
            $params = array("publicidades" => $this->publicidad->getAll());
            $this->render("Admin/publicidades.php", $params);
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    /**
     * Verifica si la session existe.
     * @return Boll retorna verdadero si la sesión existe, caso contrario retorna falso
     */
    private function verifySession(){
        $this->session->init();
        if ($this->session->getStatus()==1 || empty($this->session->get('correo'))){
            return false;
        }else {
            return true;
        }
    }  

}
