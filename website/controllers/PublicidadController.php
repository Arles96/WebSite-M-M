<?php

require_once ROOT . FOLDER_PATH .'/website/models/PublicidadModel.php';
require_once LIBS_ROUTE.'Session.php';

/**
 * Description of PublicidadController
 *
 * @author Arles Cerrato
 */
class PublicidadController extends Controller{
    
    private $session;
    private $publicidad;
    private $direccion;
    
    public function  __construct()
    {
        $this->session = new Session();
        $this->publicidad = new PublicidadModel();
        $this->direccion =  ROOT.'/'.PATH_VIEWS."public/img/";

    }


    public function exec()
    {
        if($this->verifySession()){
            $params = array("publicidades" => $this->publicidad->getAll());
            $this->render("Admin/publicidades.php", $params);
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    public function agregar (){
        if($this->verifySession()){
            $this->render("Admin/add-publicidad.php");
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    public function agregando($request){
        if ($this->verifySession()){
           if ($this->validarImagen($_FILES) && $this->validarCampos($request)){
               if ($this->guardarImagen($_FILES)){
                   $result = $this->publicidad->insert($request['codigo'], $request['nombre'], $request['tipo'], $request['descripcion'], $request['precio'], $_FILES['imagen']['name'], $this->session->get('correo'));
               }else {
                   $result = false;
               }               
               $this->verificacion($result);
            }else {
                   $params = array("mensaje"=>"Error en alguno de los campos del formulario");
                   $this->render("Admin/add-publicidad.php", $params);
               }
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    private function verificacion($result){
        if ($result){
            $params = array("mensaje"=>"Se ha agregado una publicidad");
            $this->render("Admin/add-publicidad.php", $params);
        }else {
            $params = array("mensaje"=>"Error no se pudo agregar a la base de datos");
            $this->render("Admin/add-publicidad.php", $params);
        }
    }
    
    public function eliminar($request){
        if ($this->verifySession()){
            if (is_numeric($request)){
                $result = $this->publicidad->getOne($request);
                $this->eliminando($result);
            }else {
                $params = array("mensaje" => "Error no se pudo eliminar la publicidad");
            }
        }else {
            $this->render("Admin/Access.php");
        }
    }
    
    private function eliminando ($result){
        if ($result){
            $result2 = $result->fetch_object();
            if (file_exists($this->direccion.$result2->imagen)){
                unlink($this->direccion.$result2->imagen);
                if ($this->publicidad->delete($result2->codigo, $this->session->get('correo'))){
                    header("location: ".FOLDER_PATH.'/Publicidad');
                } else {
                    header("location: ".FOLDER_PATH.'/Publicidad');
                }
            }else {
                if ($this->publicidad->delete($result2->codigo, $this->session->get('correo'))){
                    header("location: ".FOLDER_PATH.'/Publicidad');
                } else {
                    header("location: ".FOLDER_PATH.'/Publicidad');
                }
            }            
        }else {
            $params = array("mensaje"=>"Error no se elimino la publicidad", "publicidades" => $this->publicidad->getAll());
            $this->render("Admin/publicidades.php", $params);
        }
    }
    
    private function  validarImagen($file){
        if (($file['imagen']['type'] !== 'image/jpeg')) {
          return false;
        }
        if ($file['imagen']['size'] > 6000000) {
          return false;
        }
        if (file_exists($this->direccion.$file['imagen']['name'])){
            return false;
        }
        return true;
      }
      
      private function guardarImagen($file){
          $path = $this->direccion.basename($_FILES['imagen']['name']);
          if (move_uploaded_file($file['imagen']['tmp_name'], $path)) {
              return true;
          }else {
              return false;
          }
      }
      
      private function  validarCampos($request){
          if (!empty($request['codigo']) && !empty($request['nombre']) && !empty($request['tipo'])  
            && !empty($request['descripcion'])){
              if (is_numeric($request['precio'])){
                  return true;
              }else {
                  return false;
              }
          }else {
              return false;
          }
      }
      
      public function modificar($request){
          if ($this->verifySession()){
              if (is_numeric($request)){
                  $params = array("publicidad"=> $this->publicidad->getOne($request)->fetch_object());
                  $this->render("Admin/update-publicidad.php", $params);
              }
          }else {
              $this->render("Admin/Access.php");
          }
      }
      
      public function actualizando($request){
          if ($this->verifySession()){
           if ($this->validarCampos($request)){
               $result = $this->publicidad->getOne($request['codigo']);
               $this->actualizar($result, $request);              
            }else {
                   $params = array("mensaje"=>"Error en alguno de los campos del formulario");
                   $this->render("Admin/add-publicidad.php", $params);
               }
        }else {
            $this->render("Admin/Access.php");
        }
      }
      
      private function actualizar($result, $request){
            if ($result){
                $objeto = $result->fetch_object();
                $result2 = $this->publicidad->update($request['codigo'], $request['nombre'], $request['tipo'], $request['descripcion'],$request['precio'],
                        $objeto->imagen, $this->session->get('correo'));
                if ($result2){
                    header("location: ".FOLDER_PATH.'/Publicidad');
                }else {
                    $params = array("mensaje"=>"Error al actualizar los datos", "publicidad" =>$objeto);
                    $this->render("Admin/update-publicidad.php", $params);
                }    
                         
            }else {
                $params = array("mensaje"=>"Error al actualizar los datos", "publicidad" =>$objeto);
                $this->render("Admin/update-publicidad.php", $params);
            }
      }


      /**
     * Verifica si la session existe.
     * @return Boll retorna verdadero si la sesión existe, caso contrario retorna falso
     */
    private function verifySession(){
        $this->session->init();
        if ($this->session->getStatus()==1 || empty($this->session->get('correo'))){
            return false;
        }else {
            return true;
        }
    }  
    
    public function buscar($request){
        if ($this->verifySession()){
            if (!empty($request['nombre'])){
                $params = array("publicidades"=> $this->publicidad->find($request['nombre']), "busqueda" => true);
                $this->render("Admin/publicidades.php", $params);
            }else {
                header("location: ".FOLDER_PATH.'/Publicidad');
            }
        }else {
            $this->render("Admin/Access.php");
        }
    }

}
