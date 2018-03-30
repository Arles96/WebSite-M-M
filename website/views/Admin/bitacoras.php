<?php 
include_once ROOT.FOLDER_PATH."/website/views/head.php";
?>

<body>
    <div class="contanier">
        <div class="col-lg-3 menu">
            <?php    include_once 'menu_bar.php'; ?>
        </div>
        <div class="col-lg-9 principal">
            <h1 class="w3-xxlarge w3-text-red title"> <b>Bitacora</b> </h1>
            <hr class="divition w3-round">
            <?php 
                if ($bitacoras->num_rows>0){
                    echo '<table class="table table-bordered">';
                    echo '  <thead>';
                    echo '      <tr>';
                    echo '          <th>Numero Bitacora</th>';
                    echo '          <th>Administrador</th>';
                    echo '          <th>Descripción</th>';
                    echo '          <th>Fecha</th>';
                    echo '  </thead>';
                    echo '  <tbody>';
                    while ($row = mysqli_fetch_array($bitacoras)){
                        echo '      <tr>';
                        echo '          <td>'.$row['num_bitacora'].'</td>';
                        echo '          <td>'.$row['correo_adm'].'</td>';
                        echo '          <td>'.$row['descripcion'].'</td>';
                        echo '          <td>'.$row['fecha'].'</td>';
                        echo '      </tr>';
                    }
                    echo '  </tbody>'
                    . '</table>';
                }else {
                    echo '<div class="alert alert-info"><p>No hay registros en la bitacora</p></div>';
                }
            ?>
        </div>
    </div>    
</body>

</html>

