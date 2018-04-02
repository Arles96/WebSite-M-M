<?php 
include_once ROOT.FOLDER_PATH."/website/views/head.php";
?>

<body>
    <div class="contanier">
        <div class="col-lg-3 menu">
            <?php    include_once 'menu_bar.php'; ?>
        </div>
        <div class="col-lg-9 principal">
            <h1 class="w3-xxlarge w3-text-red title"> <b>Informacion del Sitio Web</b> </h1>
            <hr class="divition w3-round">
            <?php 
            if (!empty($mensaje)){
                echo '<div class="alert alert-info"><p>'.$mensaje.'</p></div>';
            }
            if (empty($info)){
                echo '<h2>Agregando Información</h2>'
                        . '<br>'
                        . '<form method="POST" action="'.FOLDER_PATH.'/Admin/AgregarInfo" >'
                        . '<div class="form-group">'
                        . '<label for="nosotros">Sobre la Distribuidora</label>'
                        . '<textarea class="form-control" rows="4" cols="50" name="nosotros" placeholder="Sobre la empresa">'
                        . '</textarea>'
                        . '</div>'
                        . '<div class="form-group">'
                        . '<label for="contacto">Texto para contactar a la Distribuidora</label>'
                        . '<textarea class="form-control" rows="4" cols"50" name="contacto" placeholder="Texto que que contacten a la empresa">'
                        . '</textarea>'
                        . '</div>'
                        . '<button class="btn btn-primary" type="submit">Agregar</button>'
                        . '</form>';
            }else {
                echo '<h2>Actualizando Información</h2>'
                        . '<br>'
                        . '<form method="POST" action="'.FOLDER_PATH.'/Admin/ActualizarInfo" >'
                        . '<input type="number" value="'.$info->numero_info.'" name="numero_info" hidden >'
                        . '<div class="form-group">'
                        . '<label for="nosotros">Sobre la Distribuidora</label>'
                        . '<textarea class="form-control" rows="4" cols="50" id="nosotros" name="nosotros">'.$info->nosotros
                        . '</textarea>'
                        . '</div>'
                        . '<div class="form-group">'
                        . '<label for="contacto">Texto para contactar a la Distribuidora</label>'
                        . '<textarea class="form-control" rows="4" cols"50" id="contacto" name="contacto">'.$info->contacto
                        . '</textarea>'
                        . '</div>'
                        . '<button class="btn btn-primary" type="submit">Actualizar</button>'
                        . '</form>';
            }
            ?>
        </div>
    </div>    
</body>

</html>
