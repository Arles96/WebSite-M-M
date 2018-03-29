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
    
}
