<?php
include_once ROOT . FOLDER_PATH . "/website/views/head.php";
?>
<body>
    <div class="contanier">
        <div class="col-lg-3 menu">
            <?php include_once 'menu_bar.php'; ?>
        </div>        
        <div class="col-lg-9 principal">
            <h1 class="w3-xxlarge w3-text-red title"> <b>Administradores</b> </h1>
            <hr class="divition w3-round">
            <form class="form-inline" method="POST" action="<?= FOLDER_PATH . "/Admin/" ?>">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            </form>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Contraseña</th>
                        <th colspan="2"> 
                            <form method="GET" action="<?= FOLDER_PATH . "/Admin/agregarAdmin" ?>">
                                <button class="btn btn-primary" type="submit">Agregar</button>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($administradores)) {
                        echo "<tr>";
                        echo "<td>" . $row['correo'] . "</td>";
                        echo "<td>**********************</td>";
                        echo "<td><a href='" . FOLDER_PATH . "/Admin/modificarAdmin/" . $row['correo'] . "' class='btn btn-success'>Editar</a></td>";
                        echo "<td><a href='" . FOLDER_PATH . "/Admin/eliminarAdmin/" . $row['correo'] . "' class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>                
            </table>            
        </div>
    </div>
</body>
</html>