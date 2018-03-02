 <?php

/**
 * Description of Model
 *
 * @author Arles Cerrato
 */
class Model {
    
    /*
     * @var Objeto
     */
    protected $db;
    
    /*
     * Inicializa la conexion a la base de datos
     */
    public  function __construct()
    {
        $this->db = new mysqli(HOST, USER, PASSWORD, DB_NAME);
    }
    
    /*
     * Finaliza la conexion a la base de datos
     */
    public function __destruct()
    {
        $this->db->close();
    }    
    
}
