<?php 
include_once ROOT.FOLDER_PATH."/website/views/head.php";
?>
<body>
    <div class="contanier">
        <div class="col-lg-3 menu">
            <?php    include_once 'menu_bar.php'; ?>
        </div>        
        <div class="col-lg-9 principal">
            <h1 class="w3-xxlarge w3-text-red title"><b>Administradores</b></h1>
            <hr class="divition w3-round">
            <h2>Actualizando Administrador</h2>
            <br>
            <form  method="POST" action="<?=FOLDER_PATH."/Admin/actualizandoAdmin/"?>">
                <input type="email" value="<?= $admin->correo?>" name="correo2" hidden>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="<?= $admin->correo ?>"  required > 
                </div>
                <div class="form-group">
                    <label for="contrasenia">Contraseña</label>
                    <input type="password" class="form-control" id="contrasenia" name="contrasenia" value="*****************"  required> 
                </div>
                <button class="btn btn-success" type="submit">Actualizar</button>
           </form>
            
    </div>
</body>
</html>


