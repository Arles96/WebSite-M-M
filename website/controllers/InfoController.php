<?php
defined('BASEPATH') or exit('No se permite acceso directo');
require_once LIBS_ROUTE.'Session.php';
require_once ROOT . FOLDER_PATH .'/website/models/InformacionModel.php';
/**
 * Description of InfoController
 *
 * @author Arles Cerrato
 */
class InfoController extends Controller{
    private $session;
    private $website;
    
    public function __construct()
    {
        $this->session = new Session();;
        $this->website = new InformacionModel();
    }

    /**
     * Metodo que controla la vista website. Muestra el registro de la tabla Informacion
     */
    public function exec()
    {
        if ($this->verifySession()){
            $params = array("info" => $this->website->getAll()->fetch_object());
            $this->render("Admin/website.php", $params);
        }else {
            $this->render("Admin/Access.php");
        }
    }
    public function AgregarInfo($request){
        if ($this->verifySession()){
            if ($this->verifyInfo($request, true)){
                $result = $this->website->insert($request['nosotros'], $request['contacto'], $this->session->get('correo'));
                if ($result){
                    $params = array("mensaje"=>"Se ha agregado informacion para el sitio web.", "info"=> $this->website->getAll()->fetch_object());
                    $this->render("Admin/website.php", $params);
                }else {
                    $params = array("mensaje"=>"Error al  agregar informacion para el sitio web.", "info"=> $this->website->getAll());
                    $this->render("Admin/website.php", $params);
                }
            }
        }
        else {
        $this->render("Admin/Access.php");
        }
    }
    
    public function actualizarInfo($request){
        if ($this->verifySession()){
            if ($this->verifyInfo($request, false)){
                $result = $this->website->update($request['numero_info'], $request['nosotros'], $request['contacto'], $this->session->get('correo'));
                if ($result){
                    $params = array("mensaje"=>"Se ha actualzado informacion para el sitio web.", 
                        "info"=> $this->website->getAll()->fetch_object());
                    $this->render("Admin/website.php", $params);
                }else {
                    $params = array("mensaje"=>"Error al  actualizar informacion para el sitio web.", 
                        "info"=> $this->website->getAll()->fetch_object());
                    $this->render("Admin/website.php", $params);
                }
            }
        }
        else {
        $this->render("Admin/Access.php");
        }
    }
    
    
    private function verifyInfo($request, $accion){
        if ($accion){
            if (empty($request['nosotros']) && empty($request['contacto'])){
                return false;
            }else {
                return true;
            }
        }else {
            if (empty($request['nosotros']) &&empty($request['contacto']) && is_numeric($request['numero_info']) ){
                return false;
            }else {
                return true;
            }
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
