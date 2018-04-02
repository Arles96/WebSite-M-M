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
            <form class="form-inline" method="POST" action="<?= FOLDER_PATH . "/Admin/" ?>">
                <div class="form-group">
                    <label for="email">Nombre:</label>
                    <input type="text" class="form-control" id="email" placeholder="Ingresar nombre" name="nombre">
                </div>
                <div class="form-group">
                    <label for="date">Fecha:</label>
                    <input type="date" class="form-control" id="date" placeholder="Ingresar fecha" name="date">
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            </form>
            <br>
            <?php 
                if ($clientes->num_rows>0){
                    echo '<table class="table table-bordered">';
                    echo '  <thead>';
                    echo '      <tr>';
                    echo '          <th>Numero Cliente</th>';
                    echo '          <th>Nombre</th>';
                    echo '          <th>Correo</th>';
                    echo '          <th>Telefono</th>';
                    echo '          <th>Mensaje</th>';
                    echo '          <th>Fecha</th>';
                    echo '          <th colspan="2"></th>'; 
                    echo '  </thead>';
                    echo '  <tbody>';
                    while ($row = mysqli_fetch_array($clientes)){
                        echo '      <tr>';
                        echo '          <td>'.$row['numero_cliente'].'</td>';
                        echo '          <td>'.$row['nombre'].'</td>';
                        echo '          <td>'.$row['correo'].'</td>';
                        echo '          <td>'.$row['telefono'].'</td>';
                        if (strlen($row['mensaje'])>16){
                            echo '          <td>'. substr($row['mensaje'], 0, 15).' ...</td>';
                        }else {
                            echo '          <td>'.$row['mensaje'].'</td>';
                        }                        
                        echo '          <td>'.$row['fecha'].'</td>';
                        echo '          <td><a href="'.FOLDER_PATH.'/Admin/modificarCliente" class="btn btn-success">Visualizar</a></td>';
                        echo '          <td><a href="'.FOLDER_PATH.'/Admin/eliminarCliente" class="btn btn-danger">Eliminar</a></td>';
                        echo '      </tr>';
                    }
                    echo '  </tbody>'
                    . '</table>';
                }else {
                    echo '<div class="alert alert-info"><p>No hay registros en la tabla clientes.</p></div>';
                }
            ?>
        </div>
    </div>    
</body>

</html>

