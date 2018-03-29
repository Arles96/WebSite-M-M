<?php
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT . FOLDER_PATH .'/website/models/AdministradorModel.php';
require_once ROOT . FOLDER_PATH .'/website/models/BitacoraModel.php';
require_once ROOT . FOLDER_PATH .'/website/models/ClienteModel.php';
require_once ROOT . FOLDER_PATH .'/website/models/InformacionModel.php';
require_once ROOT . FOLDER_PATH .'/website/models/PublicidadModel.php';
require_once LIBS_ROUTE.'Session.php';
/**
 * Esta clase se encarga de controlar todas las acciones del administrador en la base de datos
 *
 * @author Arles Cerrato
 */
class AdminController extends Controller {
    
    /**
     * Atributo para mantener la sesion de administrador
     */
    private $session;
    /**
     * Atributo para contener el modelo de la tabla administrador
     */
    private $admin;
    
    /**
     * Atributo para contener el modelo de la tabla Bitacora
     */
    private $bitacora;
    
    /**
     * Atributo para contener el modelo de la tabla Cliente
     */
    private $cliente;
    
    /**
     * Atributo para contener el modelo de la tabla informacion
     */
    private $website;
    
    /**
     * Atributo para contener el modelo de la tabla publicidad
     */
    private $publicidad;
    
    /**
     * Constructor de la clase AdminController. Aqui se iniciaiza la clase Session y el modelo Administrador
     */
    public function __construct() {
        $this->session = new Session();       
        $this->admin = new AdministradorModel();
        $this->bitacora = new BitacoraModel();
        $this->cliente = new ClienteModel();
        $this->publicidad = new PublicidadModel();
        $this->website = new InformacionModel();
    }
    
    /**
     * Metodo que ejecuta la vista del login
     */
    public function exec()
    {
        $params = array("error"=> "");
        $this->render("login.php", $params);
    }
    
    /**
     * Metodo que verifica si los parametros estan vacios
     * @param POST $request_params Son los parametros del formulario
     * @return Boolean Retorna verdadero si esta vacio
     */
    private function verify($request_params){
        return empty($request_params['correo']) OR empty($request_params['contrasenia']);
    }
    
    /**
     * Metodo que ejecuta la vista menu para la manipulacion de la base de datos
     * @param POST $request_params Son los valores que proviene del formulario del login
     */
    public function signin($request_params){
        if($this->verify($request_params)){
            $params = array("error"=>"Error en el correo o contraseña incorrecta");
            $this->render('login.php', $params);
        }else {
            $result = $this->admin->login($request_params['correo'], $request_params['contrasenia']);
            if ($result->num_rows===1){
                $result2 = $result->fetch_object();
                var_dump($result2);
                $this->session->init();
                $this->session->add('correo', $result2->CORREO);
                header("location: ".FOLDER_PATH.'/Admin/menu');
            }else {
                $params = array('error'=>"Error en el correo o contraseña incorrecta");
                $this->render('login.php', $params);
            }
        }
    }
    
    /**
     * Metodo que controla que la sesion este inicializada y asi entrar a la pagina principal para la manipulacion de l
     * a base de datos
     */
    public function menu(){
        if (!$this->verifySession()){
            $this->render("Admin/Access.php");
        }else {
            $params = array("usuario"=> $this->session->get("correo"));
            $this->render("Admin/menu.php", $params);
        }
    }
    
    /**
     * Metodo que cierra la sesion del administrador
     */
    public function salir(){
        $this->session->init();
        $this->session->close();
        header("location: ".FOLDER_PATH."/Admin");
    }
    
    /**
     * Metodo que controla la vista administradores. Muesta todos los administradores de la base de datos
     * 
     */
    public function administradores(){
        if($this->verifySession()){
            $params = array("administradores"=> $this->admin->getAll());
            $this->render("Admin/administradores.php", $params);
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    /**
     * Metodo que controla la vista bitacoras. Muesta todos los registros de la tabla bitacora
     */
    public function bitacora(){
        if($this->verifySession()){
            $params = array("bitacoras"=>$this->bitacora->getAll());
            $this->render("Admin/bitacora.php", $params);
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    /**
     * Metodo que controla la vista publicidades. Muesta todos los registros de la tabla Publicidad
     */
    public function publicidad(){
        if($this->verifySession()){
            $params = array("publicidades" => $this->publicidad->getAll());
            $this->render("Admin/publicidades.php", $params);
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    /**
     * Metodo que controla la vista clientes. Muestra todos los registros de la tabla clientes
     */
    public function clientes(){
        if ($this->verifySession()){
            $params = array("clientes"=>$this->cliente->getAll());
            $this->render("Admin/clientes.php", $params);
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    /**
     * Metodo que controla la vista website. Muestra el registro de la tabla Informacion
     */
    public function website(){
        
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
