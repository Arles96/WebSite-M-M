<?php

class InformacionModel extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function getAll(){
        $sql = "SELECT * FROM `vw_informacion`";
        return $this->db->query($sql);
    }
    
}
