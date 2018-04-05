<?php

require_once ROOT . FOLDER_PATH .'/website/models/ClienteModel.php';
require_once LIBS_ROUTE.'Session.php';

/**
 * Description of ClientesController
 *
 * @author Arles Cerrato
 */
class ClientesController extends Controller {
    
    private $session;
    private $cliente;
    
    public function __construct()
    {
        $this->session = new Session();
        $this->cliente = new ClienteModel();
    }
    
    /**
     * Metodo que controla la vista clientes. Muestra todos los registros de la tabla clientes
     */
    public function exec()
    {
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
    public function modificar($num){
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
    public  function actualizando($request){
        if ($this->verifySession()){
            if ($this->verifyUpdateCliente($request)){
                $result = $this->cliente->update($request['numero_cliente'], $request['nombre'], $request['mensaje'], 
                        $request['correo'], $request['telefono'], $this->session->get('correo'));
                var_dump($result);
                if ($result){
                    header("location: ".FOLDER_PATH."/Clientes");
                }
                else {
                    $params = array("clientes"=> $this->cliente->getAll(), "mensaje"=>"Error al actualizar los datos de un cliente.");
                    $this->render("Admin/clientes.php", $params);
                }
            }else {
                header("location: ".FOLDER_PATH."/Clientes");
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
    
    public function eliminar($num){
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
