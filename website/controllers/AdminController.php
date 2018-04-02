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
     * Metodo que controla la vista bitacoras. Muesta todos los registros de la tabla bitacora
     */
    public function bitacora(){
        if($this->verifySession()){
            $params = array("bitacoras"=>$this->bitacora->getAll());
            $this->render("Admin/bitacoras.php", $params);
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
     * Metodo que controla la vista website. Muestra el registro de la tabla Informacion
     */
    public function website(){
        if ($this->verifySession()){
            $params = array("info" => $this->website->getAll()->fetch_object());
            $this->render("Admin/website.php", $params);
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    /**
     *Metodo que controla la vista de agregar un registro en la tabla de administradores
     */
    public function agregarAdmin(){
         if ($this->verifySession()){
            $params = array("mensaje"=>"");
            $this->render("Admin/add-admin.php", $params);
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    //*******************Inicio con los metodos para los administradores*******************************/
    
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
     * Metodo que controla la accion de agregar un registro en la tabla administrador
     * @param array $request  Arreglo que envia el formulario
     */
    public function agregandoAdmin($request){
        if ($this->verifySession()){
            if (empty($request['correo']) || empty($request['contrasenia'])){
                $params = array("mensaje"=>"Alguno de los campos estan vacios");
                $this->render("Admin/add-admin.php", $params);
            }else {
                $result = $this->admin->insert($request['correo'], $request['contrasenia']);
                $this->agregarAdministrador($result);
            }
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    /**
     * Metodo private para notificar si se agregago un registro en la tabla administrador
     */
    private function agregarAdministrador($result){
        if ($result) {
            $params = array("mensaje"=>"Se ha agregado un registro");
            $this->render("Admin/add-admin.php", $params);
        }else {
            $params = array("mensaje"=>"Error no se pudo agregar el registro");
            $this->render("Admin/add-admin.php", $params);
        }
    }
    
    /**
     * Metodo que controla la vista de actualizar un registro de la tabla administrador
     */
    public function modificarAdmin($param){
        if($this->verifySession()){
            if (!empty($param)){
                $params = array("admin"=>$this->admin->getOne($param)->fetch_object());
                $this->render("Admin/update-admin.php", $params);
            }
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    /**
     * Metodo que controla la actualizacion de la informacion de un registro de la tabla administrador
     */
    public function actualizandoAdmin($request){
        if ($this->verifySession()){
            if ($request['correo2'] === $this->session->get('correo') && !empty($request['correo']) && !empty($request['contrasenia'])){
                $result = $this->admin->update($request['correo2'], $request['correo'], $request['contrasenia'], $this->session->get('correo'));
                $this->updateAdmin($result);
            }else {
                $params = array('mensaje' => 'Error al actualizar los datos. Tiene que ser el mismo administrador de la sesión.');
                $this->render("Admin/update-admin.php", $params);
            }
        }
    }
    
    /**
     * Metodo privado que indica si se realizo la actualizacion de los datos en la tabla administradores
     */
    private function updateAdmin($result){
        if ($result){
            header("location: ".FOLDER_PATH.'/Admin/administradores');
        }else {
            $params = array("mensaje"=>"Error al actualizar los datos.");
            $this->render("Admin/update-admin.php", $params);
        }
    }
    
    /**
     * Metodo para eliminar un administrador
     */
    public function eliminarAdmin($admin){
        if ($this->verifySession()){
            if (!empty($admin)){
                $this->admin->delete($admin, $this->session->get('correo'));
                header("location: ".FOLDER_PATH.'/Admin/administradores');
            }
        }else {
            $this->render('Admin/Access.php');
        }
    }
    
    //*******************Fin de los metodos para los administradores*******************************/
    
    /*******************Inicio con los metodos para los clientes**************************************/

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
     * Metodo para visualizar los datos de los clientes
     */
    public function modificarCliente($num){
        if ($this->verifySession()){
            if (is_numeric($num)){
                $params = array("cliente"=> $this->cliente->getOne($num)->fetch_object());
                $this->render('Admin/update-cliente.php', $params);
            }else {
                header("location: ".FOLDER_PATH."/Admin/clientes");
            }
        }
        else {
            $this->render("Admin/Access.php");
        }
    }
    
    /**
     * Metodo para actualizar los datos de los clientes
     */
    public  function actualizandoCliente($request){
        if ($this->verifySession()){
            if ($this->verifyUpdateCliente($request)){
                $result = $this->cliente->update($request['numero_cliente'], $request['nombre'], $request['mensaje'], 
                        $request['correo'], $request['telefono'], $this->session->get('correo'));
                var_dump($result);
                if ($result){
                    header("location: ".FOLDER_PATH."/Admin/clientes");
                }
                else {
                    $params = array("clientes"=> $this->cliente->getAll(), "mensaje"=>"Error al actualizar los datos de un cliente.");
                    $this->render("Admin/clientes.php", $params);
                }
            }else {
                header("location: ".FOLDER_PATH."/Admin/clientes");
            }
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    private function verifyUpdateCliente($request){
        if (is_numeric($request['numero_cliente']) && !empty($request['nombre']) && !empty($request['correo']) && 
                !empty($request['telefono']) && !empty($request['fecha']) && !empty($request['mensaje'])){
            return true;
        }else {
            return false;
        }
    }
    
    public function eliminarCliente($num){
        if ($this->verifySession()){
            if (is_numeric($num)){
                $result = $this->cliente->delete($num, $this->session->get('correo'));
                if ($result){
                    $params = array("clientes" => $this->cliente->getAll(), "mensaje"=>"Se elimino un cliente de la base de datos.");
                    $this->render("Admin/clientes.php", $params);
                }else {
                    $params = array("clientes" => $this->cliente->getAll(), "mensaje"=>"Error al eliminar un cliente");
                    $this->render("Admin/clientes.php", $params);
                }
            }
        }else {
            $this->render("Admin/Access.php");
        }
    }


    /********************************Fin de los metodos de los clientes*********************************/

    /*******************************Inicio de los metodos de la informacion del Website*************/
    
    public function AgregarInfo($request){
        if ($this->verifySession()){
            if ($this->verifyInfo($request, true)){
                
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
            if (empty($request['nosotros']) &&empty($request['contacto']) && empty($request['numero_info']) ){
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
