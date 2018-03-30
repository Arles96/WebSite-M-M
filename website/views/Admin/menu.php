<?php 
include_once ROOT.FOLDER_PATH."/website/views/head.php";
?>
    <body>
        <div class="contanier">
            <div class="col-lg-3 menu">
                <?php include_once 'menu_bar.php'; ?>                
            </div>
            <div class="col-lg-9 principal">
                <h1 class="w3-xxlarge w3-text-red title"> <b>Bienvenido</b> </h1>
                <hr class="divition w3-round">
                <p class="text-principal">
                    Bienvenido <?php echo $usuario;?> esta es la página principal 
                    para modificar la base de datos de la Distribuidora M&M. Aquí podras
                    insertar, actualizar y eliminar los registros de la base de datos.
                </p>
                <p class="text-principal">
                    La Distribuidora posee las siguientes tablas
                </p>
                <ul class="text-principal">
                    <li>Administradores: esta tabla posee todos los administradores de la empresa.</li>
                    <li>Bitacora: esta tabla posee todas las actividades de la base de datos de la empresa. </li>
                    <li>Publicidad: esta tabla posee toda la publicidad de los productos que se muestra en el sitio web.</li>
                    <li>Cliente: esta tabla posee todos los contactos que tuvo el sitio web.</li>
                    <li>Web Site: esta tabla posee la informacion que contendra el sitio web en las secciones "Sobre Nosotros" y "Contactanos" del sitio web</li>
                </ul>
            </div>
        </div>
    </body>
</html>


