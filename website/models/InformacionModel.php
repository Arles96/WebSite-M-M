<?php

class InformacionModel extends Model {

    /**
     * Contructor de la clase InformacionModel para CRUD de la tabla informacion
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Metodo que obtiene todos los clientes de la vista vw_informacion
     */
    public function getAll() {
        $sql = "SELECT * FROM `vw_informacion`";
        return $this->db->query($sql);
    }

    /**
     * Metodo para insertar un registro en la tabla informacion
     */
    public function insert($nosotros, $contacto, $admin) {
        $nosotros2 = $this->db->real_escape_string($nosotros);
        $contacto2 = $this->db->real_escape_string($contacto);
        $admin2 = $this->db->real_escape_string($admin);
        $sql = "CALL `INSERT_INFORMATION`('" . $nosotros2 . "', '" . $contacto2 . "', '" . $admin2 . "')";
        return $this->db->query($sql);
    }

    /**
     * Metodo para actualizar un registro en la tabla informacion
     */
    public function update($numero, $nosotros, $contacto, $admin) {
     var_dump($numero);
        $nosotros2 = $this->db->real_escape_string($nosotros);
        $contacto2 = $this->db->real_escape_string($contacto);
        $admin2 = $this->db->real_escape_string($admin);
        $sql = "CALL `UPDATE_INFORMACION`(" . $numero . ", '" . $nosotros2 . "', '" . $contacto2 . "', '" . $admin2 . "')";
        return $this->db->query($sql);
    }

    /**
     * Metodo para eliminar un registro en la tabla informacion
     */
    public function delete($numero, $admin) {
        $numero2 = $this->db->real_escape_string($numero);
        $admin2 = $this->db->real_escape_string($admin);
        $sql = "CALL `DELETE_INFORMACION`('" . $numero2 . "', '" . $admin2 . "')";
        return $this->db->query($sql);
    }

}
