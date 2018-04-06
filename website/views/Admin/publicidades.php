<?php
include_once ROOT . FOLDER_PATH . "/website/views/head.php";
?>

<body>
    <div class="contanier">
        <div class="col-lg-3 menu">
            <?php include_once 'menu_bar.php'; ?>
        </div>
        <div class="col-lg-9 principal">
            <h1 class="w3-xxlarge w3-text-red title"> <b>Publicidad</b> </h1>
            <hr class="divition w3-round">
            <?php
            if ($publicidades->num_rows > 0) {
                echo '
                <form class="form-inline" method="POST" action="'.FOLDER_PATH.'/Publicidad/buscar ">
                <div class="form-group">
                    <label for="email">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingresar nombre" name="nombre">
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
                </form>
                <br>';
                echo '<table class="table table-bordered">';
                echo '  <thead>';
                echo '      <tr>';
                echo '          <th>Código</th>';
                echo '          <th>Nombre</th>';
                echo '          <th>Tipo</th>';
                echo '          <th>Descripción</th>';
                echo '          <th>Precio</th>';
                echo '          <th>imagen</th>';
                echo '          <th colspan="2">
                                        <a href="'.FOLDER_PATH.'/Publicidad/agregar" class="btn btn-primary">Agregar</a>
                                    </th>';
                echo '  </thead>';
                echo '  <tbody>';
                while ($row = mysqli_fetch_array($publicidades)) {
                    echo '      <tr>';
                    echo '          <td>' . $row['codigo'] . '</td>';
                    echo '          <td>' . $row['nombre'] . '</td>';
                    echo '          <td>' . $row['tipo'] . '</td>';
                    if (strlen($row['descripcion']) > 16) {
                        echo '          <td>' . substr($row['descripcion'], 0, 15) . ' ...</td>';
                    } else {
                        echo '          <td>' . $row['descripcion'] . '</td>';
                    }
                    echo '          <td>' . $row['precio'] . '</td>';
                    echo '          <td>' . $row['imagen'] . '</td>';
                    echo "<td><a href='" . FOLDER_PATH . "/Publicidad/modificar/" . $row['codigo'] . "' class='btn btn-success'>Editar</a></td>";
                    echo "<td><a href='" . FOLDER_PATH . "/Publicidad/eliminar/" . $row['codigo'] . "' class='btn btn-danger'>Eliminar</a></td>";
                    echo '      </tr>';
                }
                echo '  </tbody>'
                . '</table>';
            } else {
                if (!empty($busqueda)){
                    echo '
                        <form class="form-inline" method="POST" action="'.FOLDER_PATH.'/Publicidad/buscar ">
                        <div class="form-group">
                            <label for="email">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingresar nombre" name="nombre">
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                        </form>
                        <br>';
                    echo '<div class="alert alert-info"><p>No hay registros en la  publicidad </p>';
                }
                else {
                    echo '<div class="alert alert-info"><p>No hay registros en la tabla publicidad </p>'
                        . '<br>'
                        . '<a href="'.FOLDER_PATH.'/Publicidad/agregar" class="btn btn-primary">Agregar</a>'
                        . '</div>';                }
                
            }
            ?>
        </div>
    </div>    
</body>
</html>
