<?php

class AdministradorModel extends Model {
    
    /**
     * Constructor de la clase AdministradorModel para realizar operaciones en la tabla Administrador
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Metodo para seleccionar el administrador que esta realizando el login
     * @param string $correo Correo del administrador
     * @param string $contrasenia Contraseña del administrador
     */
    public function login($correo, $contrasenia){
        $correo2 = $this->db->real_escape_string($correo);
        $contrasenia2 = $this->db->real_escape_string($contrasenia);
        $sql = "CALL `LOGIN`('{$correo2}', '{$contrasenia2}')";
        $result = $this->db->query($sql);
        return $result;
    }
    
    /**
     * Metodo para seleccionar todos los administradores de la tabla administrador
     */
    public function getAll(){
        $sql = "SELECT * FROM `vw_administrador`";
        return $this->db->query($sql);
    }
    
    /**
     * Metodo para insertar un registro en la tabla administrador
     * @param string $correo Correo del administrador
     * @param string $contrasenia Contraseña del administrador
     */
    public function insert($correo, $contrasenia){
        $correo2= $this->db->real_escape_string($correo);
        $contrasenia2 = $this->db->real_escape_string($contrasenia);
        $sql = "CALL `CREATE_ADMIN`('".$correo2."', '".$contrasenia2."')";
        return $this->db->query($sql);
    }
    
    /**
     * Metodo para actualizar la informacion de un administrador
     * @param string $id_correo Correo del administrador para seleccionar
     * @param string $correo Nuevo correo del administrador
     * @param string $contrasenia Nueva contrasenia del administrador
     * @param string $admin Correo del administrador que esta realizando los cambios
     */
    public function update($id_correo, $correo, $contrasenia, $admin){
        $correo2 = $this->db->real_escape_string($id_correo);
        $correo3 = $this->db->real_escape_string($correo);
        $contrasenia2 = $this->db->real_escape_string($contrasenia);
        $admin2 = $this->db->real_escape_string($admin);
        $sql = "CALL `UPDATE_ADMINISTRADOR`('".$correo2."', '".$correo3."', '".$contrasenia2."', '".$admin2."')";
        return $this->db->query($sql);
    }
    
    /**
     * Metodo para eliminar un administrador
     * @param string $correo Correo del administrador a eliminar
     * @param string $admin Correo del administrador que esta realizando la eliminacion
     */
    public function delete($correo, $admin){
        $corre2 = $this->db->real_escape_string($correo);
        $admin2 = $this->db->real_escape_string($admin);
        $sql = "CALL `DELETE_ADMINISTRADOR`('".$corre2."', '".$admin2."')";
        return $this->db->query($sql);
    }
    
}

