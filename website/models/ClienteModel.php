<?php

class ClienteModel extends Model {
    
    /**
     * Contructor de la clase ClienteModel para CRUD de la tabla clientes
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Metodo que obtiene todos los clientes de la vista vw_clientes
     */
    public function getAll(){
        $sql = "SELECT * FROM `vw_cliente`";
        return $this->db->query($sql);
    }    
    
    /**
     * Metodo para insertar un registro en la tabla clientes 
     */
    public function insert($nombre, $mensaje, $correo, $telefono){
        $nombre2 = $this->db->real_escape_string($nombre);
        $mensaje2 = $this->db->real_escape_string($mensaje);
        $correo2 = $this->db->real_escape_string($correo);
        $telefono2 = $this->db->real_escape_string($telefono);
        $sql = "CALL `INSERT_CLIENTE`('".$nombre2."', '".$mensaje2."', '".$correo2."', '".$telefono2."')";
        return $this->db->query($sql);
    }
}

