<?php

class AdministradorModel extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function insert($correo = "", $contrasenia=""){
        if ($correo=="" && $contrasenia==""){
            return false;
        }else {
            $this->db->query("CALL CREATE_ADMIN(".$correo.", ".$contrasenia. ")");
            return true;
        }
    }
    
    public function login($correo, $contrasenia){
        $correo2 = $this->db->real_escape_string($correo);
        $contrasenia2 = $this->db->real_escape_string($contrasenia);
        $sql = "CALL `LOGIN`('{$correo2}', '{$contrasenia2}')";
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function getAll(){
        $sql = "SELECT * FROM `vw_administrador`";
        return $this->db->query($sql);
    }
    
}

