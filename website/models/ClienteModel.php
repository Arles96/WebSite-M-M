<?php

class ClienteModel extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function getAll(){
        $sql = "SELECT * FROM `vw_cliente`";
        return $this->db->query($sql);
    }    
}

