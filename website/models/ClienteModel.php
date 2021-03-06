<?php

class ClienteModel extends Model {

    /**
     * Contructor de la clase ClienteModel para CRUD de la tabla clientes
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Metodo que obtiene todos los clientes de la vista vw_clientes
     */  
    public function getAll() {
        $sql = "SELECT * FROM `vw_cliente`";
        return $this->db->query($sql);
    }

    /**
     * Metodo para insertar un registro en la tabla clientes 
     */
    public function insert($nombre, $mensaje, $correo, $telefono) {
        $nombre2 = $this->db->real_escape_string($nombre);
        $mensaje2 = $this->db->real_escape_string($mensaje);
        $correo2 = $this->db->real_escape_string($correo);
        $telefono2 = $this->db->real_escape_string($telefono);
        $sql = "CALL `INSERT_CLIENTE`('" . $nombre2 . "', '" . $mensaje2 . "', '" . $correo2 . "', '" . $telefono2 . "')";
        return $this->db->query($sql);
    }

    /**
     * Metodo para actualizar un registro en la tabla clientes 
     */
    public function update($numero, $nombre, $mensaje, $correo, $telefono, $admin) {
        $nombre2 = $this->db->real_escape_string($nombre);
        $mensaje2 = $this->db->real_escape_string($mensaje);
        $correo2 = $this->db->real_escape_string($correo);
        $admin2 = $this->db->real_escape_string($admin);
        $telefono2 = $this->db->real_escape_string($telefono);
        echo $numero;
        $sql = "CALL `UPDATE_CLIENTE`(".$numero.", '".$nombre2."', '".$mensaje2."', '".$correo2."', '".$telefono2."', '".$admin2."')";
        return $this->db->query($sql);
    }

    /**
     * Metodo para eliminar un registro en la tabla clientes 
     */
    public function delete($numero, $admin) {
        $admin2 = $this->db->real_escape_string($admin);
        $sql = "CALL `DELETE_CLIENTE`(" . $numero . ",'" . $admin2 . "')";
        return $this->db->query($sql);
    }
    
    public function getOne($codigo){
        $sql = "SELECT * FROM `vw_cliente` WHERE numero_cliente=".$codigo;
        return $this->db->query($sql);
    }

    public function findName($name){
        $nombre = $this->db->real_escape_string($name);
        $sql = "SELECT * FROM `vw_cliente` WHERE `nombre` LIKE '%".$nombre."%'";
        return $this->db->query($sql);
    }
    
    public function findDate ($date){
        $fecha = $this->db->real_escape_string($date);
        $sql = "SELECT * FROM `vw_cliente` WHERE `fecha`='".$fecha."'";
        return $this->db->query($sql);
    }
    
    public function findNameDate($name, $date){
        $nombre = $this->db->real_escape_string($name);
        $fecha = $this->db->real_escape_string($date);
        $sql = "SELECT * FROM `vw_cliente` WHERE `nombre` LIKE '%".$nombre."%' AND `fecha`='".$fecha."'";
        return $this->db->query($sql);
    }
    
}
