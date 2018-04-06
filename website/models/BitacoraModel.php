<?php

class BitacoraModel extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getAll(){
        $sql = "SELECT * FROM `vw_bitacora`";
        return $this->db->query($sql);
    }
    
    public function findEmail($email){
        $correo = $this->db->real_escape_string($email);
        $sql = "SELECT * FROM `vw_bitacora` WHERE `correo_adm` LIKE '%".$correo."%'";
        return $this->db->query($sql);
    }
    
    public function findDates($date){
        $fecha = $this->db->real_escape_string($date);
        $sql = "SELECT * FROM `vw_bitacora` WHERE `fecha`='".$fecha."'";
        return $this->db->query($sql);
    }
    
    public function  findEmailDate($email, $date){
        $correo = $this->db->real_escape_string($email);
        $fecha = $this->db->real_escape_string($date);
        $sql = "SELECT * FROM `vw_bitacora` WHERE `correo_adm` LIKE '%".$correo."%' AND `fecha`='".$fecha."'";
        return $this->db->query($sql);
    }
    
}
