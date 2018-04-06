<?php 
include_once ROOT.FOLDER_PATH."/website/views/head.php";
?>
<body>
    <div class="contanier">
        <div class="col-lg-3 menu">
            <?php    include_once 'menu_bar.php'; ?>
        </div>        
        <div class="col-lg-9 principal">
            <h1 class="w3-xxlarge w3-text-red title"><b>Publicidad</b></h1>
            <hr class="divition w3-round">
            <h2>Agregando Publicidad</h2>
            <br>
            <?php 
            if (!empty($mensaje)){
                echo '<div class="alert alert-info"><p>'.$mensaje.'</p></div>';
            }
            ?>
            <form  method="POST" enctype="multipart/form-data" action="<?=FOLDER_PATH."/Publicidad/agregando"?>">
                <div class="form-group">
                    <label for="correo">Codigo</label>
                    <input type="number" class="form-control"  name="codigo" placeholder="Codigo" required > 
                </div>
                <div class="form-group">
                    <label for="contrasenia">Nombre</label>
                    <input type="text" class="form-control"  name="nombre" placeholder="Nombre" required> 
                </div>
                <div class="form-group">
                    <label for="contrasenia">Tipo</label>
                    <input type="text" class="form-control"  name="tipo" placeholder="Tipo" required> 
                </div>
                <div class="form-group">
                    <label for="contrasenia">Descripción</label>
                    <textarea rows="4" class="form-control" name="descripcion"></textarea>
                </div>
                <div class="form-group">
                    <label for="contrasenia">Precio</label>
                    <input type="number" step="any" class="form-control"  name="precio" placeholder="Precio" required> 
                </div>
                <div class="form-group">
                    <label for="contrasenia">Imagen</label>
                    <input type="file" class="form-control"  name="imagen" required> 
                </div>
                <button class="btn btn-primary" type="submit">Agregar</button>
           </form>
            
    </div>
</body>
</html>

