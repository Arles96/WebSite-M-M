<?php 
include_once ROOT.FOLDER_PATH."/website/views/head.php";
?>

<body>
    <div class="contanier">
        <div class="col-lg-3 menu">
            <?php    include_once 'menu_bar.php'; ?>
        </div>
        <div class="col-lg-9 principal">
            <h1 class="w3-xxlarge w3-text-red title"> <b>Publicidad</b> </h1>
            <hr class="divition w3-round">
            <?php 
                if ($publicidades->num_rows>0){
                    echo '<table class="table table-bordered">';
                    echo '  <thead>';
                    echo '      <tr>';
                    echo '          <th>Código</th>';
                    echo '          <th>Nombre</th>';
                    echo '          <th>Tipo</th>';
                    echo '          <th>Descripción</th>';
                    echo '          <th>Precio</th>';
                    echo '          <th>imagen</th>';
                    echo '          <th colspan="2"><form method="GET" action="<?= FOLDER_PATH."/Admin/Publicidad"?>
                                        <button class="btn btn-primary" type="submit">Agregar</button>
                                        </form></th>';
                    echo '  </thead>';
                    echo '  <tbody>';
                    while ($row = mysqli_fetch_array($publicidades)){
                        echo '      <tr>';
                        echo '          <td>'.$row['codigo'].'</td>';
                        echo '          <td>'.$row['nombre'].'</td>';
                        echo '          <td>'.$row['tipo'].'</td>';
                        if (strlen($row['descripcion'])>16){
                            echo '          <td>'. substr($row['descripcion'], 0, 15).' ...</td>';
                        }else {
                            echo '          <td>'.$row['descripcion'].'</td>';
                        }    
                        echo '          <td>'.$row['precio'].'</td>';
                        echo '          <td>'.$row['imagen'].'</td>';
                        echo "<td><a href='".FOLDER_PATH."/Admin/modificarPublicidad/".$row['codigo']."' class='btn btn-success'>Editar</a></td>";
                        echo "<td><a href='".FOLDER_PATH."/Admin/eliminarPublicidad/".$row['codigo']."' class='btn btn-danger'>Eliminar</a></td>";
                        echo '      </tr>';
                    }
                    echo '  </tbody>'
                    . '</table>';
                }else {
                    echo '<div class="alert alert-info"><p>No hay registros en la tabla publicidad</p></div>';
                }
            ?>
        </div>
    </div>    
</body>

</html>

