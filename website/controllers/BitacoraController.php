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
    
    public function buscar($request){
        if ($this->verifySession()){
            if (empty($request['email'])){
                $params = array("bitacoras"=> $this->bitacora->findDates($request['fecha']), "busqueda" => true);
                $this->render("Admin/bitacoras.php", $params);
            }else if (empty ($request['fecha'])){
                $params = array("bitacoras"=> $this->bitacora->findEmail($request['email']), "busqueda" => true);
                $this->render("Admin/bitacoras.php", $params);
            }else if (!empty ($request['email']) && !empty ($request['fecha'])) {
                $params = array("bitacoras"=> $this->bitacora->findEmailDate($request['email'], $request['fecha']), "busqueda" => true);
                $this->render("Admin/bitacoras.php", $params);
            }else {
                header("location: ".FOLDER_PATH."/Bitacora"); 
            }
        }else {
        $this->render("Admin/Access.php");
        }
    }
}
