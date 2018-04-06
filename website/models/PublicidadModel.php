<?php

class PublicidadModel extends Model {

    /**
     * Contructor de la clase InformacionModel para CRUD de la tabla publicidad
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Metodo que obtiene todos los clientes de la vista vw_publicidad
     */
    public function getAll() {
        $sql = "SELECT * FROM `vw_publicidad`";
        return $this->db->query($sql);
    }
    
    public function getOne($codigo) {
        $sql = "SELECT * FROM `vw_publicidad` WHERE `codigo`=".$codigo;
        return $this->db->query($sql);
    }

    /**
     * Metodo para insertar un registro en la tabla publicidad
     */
    public function insert($codigo, $nombre, $tipo, $descripcion, $precio, $imagen, $admin) {
        $codigo2 = $this->db->real_escape_string($codigo);
        $nombre2 = $this->db->real_escape_string($nombre);
        $tipo2 = $this->db->real_escape_string($tipo);
        $descripcion2 = $this->db->real_escape_string($descripcion);
        $precio2 = $this->db->real_escape_string($precio);
        $imagen2 = $this->db->real_escape_string($imagen);
        $admin2 = $this->db->real_escape_string($admin);
        $sql = "CALL `INSERT_PUBLICIDAD`('" . $codigo2 . "', '" . $nombre2 . "', '" . $tipo2 . "','" . $descripcion2 . "','" . $precio2 . "','" . $imagen2 . "','" . $admin2 . "')";
        return $this->db->query($sql);
    }

    /**
     * Metodo para actualizar un registro en la tabla publicidad
     */
    public function update($codigo, $nombre, $tipo, $descripcion, $precio, $imagen, $admin) {
        $nombre2 = $this->db->real_escape_string($nombre);
        $tipo2 = $this->db->real_escape_string($tipo);
        $descripcion2 = $this->db->real_escape_string($descripcion);
        $precio2 = $this->db->real_escape_string($precio);
        $imagen2 = $this->db->real_escape_string($imagen);
        $admin2 = $this->db->real_escape_string($admin);
        $sql = "CALL `UPDATE_PUBLICIDAD`(" . $codigo . ", '" . $nombre2 . "', '" . $tipo2 . "','" . $descripcion2 . "','" . $precio2 . "','" . $imagen2 . "','" . $admin2 . "')";
        return $this->db->query($sql);
    }
    
    /**
     * Metodo para eliminar un registro en la tabla publicidad
     */
    public function delete($codigo,$admin) {
        $codigo2 = $this->db->real_escape_string($codigo);
        $admin2 = $this->db->real_escape_string($admin);
        $sql = "CALL `DELETE_PUBLICIDAD`('" . $codigo2 . "','" . $admin2 . "')";
        return $this->db->query($sql);
    }
    
    public function find($name){
        $nombre = $this->db->real_escape_string($name);
        $sql = "SELECT * FROM `vw_publicidad` WHERE `nombre` LIKE '%".$nombre."%'";
        return $this->db->query($sql);
    }
}
