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
    
}

