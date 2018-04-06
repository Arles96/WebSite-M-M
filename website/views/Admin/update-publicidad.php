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
            <h2>Actualizando Publicidad</h2>
            <br>
            <?php 
            if (!empty($mensaje)){
                echo '<div class="alert alert-info"><p>'.$mensaje.'</p></div>';
            }
            ?>
            <div class="col-lg-6">
                <form  method="POST" enctype="multipart/form-data" action="<?=FOLDER_PATH."/Publicidad/actualizando"?>">                    
                    <input type="number" class=""  name="codigo" value="<?= $publicidad->codigo ?>" hidden >                     
                    <div class="form-group">
                        <label for="contrasenia">Nombre</label>
                        <input type="text" class="form-control"  name="nombre" value="<?= $publicidad->nombre ?>"  required> 
                    </div>
                    <div class="form-group">
                        <label for="contrasenia">Tipo</label>
                        <input type="text" class="form-control"  name="tipo" value="<?= $publicidad->tipo ?>"  required> 
                    </div>
                    <div class="form-group">
                        <label for="contrasenia">Descripción</label>
                        <textarea rows="4" class="form-control" name="descripcion"><?= $publicidad->descripcion ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="contrasenia">Precio</label>
                        <input type="number" step="any" class="form-control"  name="precio" value="<?= $publicidad->precio ?>"  required> 
                    </div>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
               </form>
            </div>
            <div class="col-lg-6 text-center">
                <img src="<?php echo PATH_IMG.$publicidad->imagen; ?>" alt="<?= $publicidad->imagen ?>" class="img-thumbnail" width="304" height="236">
            </div>
            
    </div>
</body>
</html>
