<?php

/**
 * Clase padre que se utilizara para mostrar las plantillas de html
 *
 * @author Arles Cerrato
 */
class View {
    
    /*
     * @var string
     */
    protected $template;
    
    /*
     * @var array
     */
    protected $params;
    
    /*
     * Inicializa los valores y renderiza
     * @param string  $template_name
     * @param array $params. Opcional
     */
    public function __construct($template = "", $params = array())
    {
        $this->template = $template;
        $this->params = $params;
        $this->render();
    }
    
    protected function render(){
        $file = ROOT.PATH_VIEWS . $template.".php";
        if (is_file($file))
        {
            extract($this->params);
            ob_start();
            require($file);
            ob_end_clean();
        }else {
            throw new Exception("Error, no existe la plantilla en $file");
        }
    }
    
}
