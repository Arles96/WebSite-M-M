<?php 
include_once ROOT.FOLDER_PATH."/website/views/head.php";
?>

<body>
    <div class="contanier">
        <div class="col-lg-3 menu">
            <?php    include_once 'menu_bar.php'; ?>
        </div>
        <div class="col-lg-9 principal">
            <h1 class="w3-xxlarge w3-text-red title"> <b>Clientes</b> </h1>
            <hr class="divition w3-round">
            <h2>Visualizando y Actualizando Cliente</h2>
            <?php
            if (!empty($mensaje)){
                echo '<div class="alert alert-info"><p>'.$mensaje-'</p></div>';
            }
            ?>
            <form  method="POST" action="<?=FOLDER_PATH."/Clientes/actualizando"?>">
                <input type="number" value="<?= $cliente->numero_cliente?>" name="numero_cliente" hidden>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control"  name="nombre" value="<?= $cliente->nombre ?>"  required > 
                </div>
                <div class="form-group">
                    <label for="contrasenia">Correo</label>
                    <input type="email" class="form-control" name="correo" value="<?=$cliente->correo?>"  required> 
                </div>
                <div class="form-group">
                    <label for="contrasenia">Telefono</label>
                    <input type="text" class="form-control" name="telefono" value="<?=$cliente->telefono?>"  required> 
                </div>
                <div class="form-group">
                    <label for="contrasenia">Fecha</label>
                    <input type="date" class="form-control" name="fecha" value="<?=$cliente->fecha?>"  required> 
                </div>
                <div class="form-group">
                    <label for="contrasenia">Mensaje</label>
                    <textarea rows="4" class="form-control" name="mensaje"><?= $cliente->mensaje ?></textarea>
                </div>
                <button class="btn btn-success" type="submit">Actualizar</button>
           </form>
        </div>
    </div>    
</body>

</html>

