<?php

defined('BASEPATH') or exit('No se permite el acceso');
require_once ROOT . FOLDER_PATH .'/website/models/ClienteModel.php';
require_once ROOT . FOLDER_PATH .'/website/models/InformacionModel.php';
require_once ROOT . FOLDER_PATH .'/website/models/PublicidadModel.php';
/**
 * Description of InicioController
 *
 * @author Arles Cerrato
 */
class InicioController extends Controller{   
    
    private $publicidad;
    private $website;
    private $cliente;
    
    /*
     * Contructor de la clase InicioController
     */
    public function __construct()
    {
        $this->publicidad = new PublicidadModel();
        $this->website = new InformacionModel();
        $this->cliente = new ClienteModel();
    }
    
    /*
     * Se renderiza la plantilla inicio
     */
    public function exec()
    {
        $params = array("publicidad" => $this->publicidad->getAll(), "info" => $this->website->getAll()->fetch_object());
        $this->render("Inicio.php", $params);
    }

}