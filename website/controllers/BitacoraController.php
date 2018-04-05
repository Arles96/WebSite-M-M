<?php

require_once LIBS_ROUTE.'Session.php';
require_once ROOT . FOLDER_PATH .'/website/models/BitacoraModel.php';

/**
 * Description of BitacoraController
 *
 * @author Arles Cerrato
 */
class BitacoraController extends Controller{
    
    private $session;
    private $bitacora;
    
    public function __construct()
    {
        $this->session = new Session();
        $this->bitacora = new BitacoraModel();
    }

        public function exec()
    {
        if($this->verifySession()){
            $params = array("bitacoras"=>$this->bitacora->getAll());
            $this->render("Admin/bitacoras.php", $params);
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
