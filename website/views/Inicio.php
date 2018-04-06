<?php include_once 'head.php'; ?>
    <body>
        <!-- Navbar (sit on top) -->
        <div class="w3-top">
          <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
            <a href="#home" class="w3-bar-item w3-button">Distribuidora M&M</a>
            <!-- Right-sided navbar links. Hide them on small screens -->
            <div class="w3-right w3-hide-small">
              <a href="#about" class="w3-bar-item w3-button">Sobre Nosotros</a>
              <a href="#menu" class="w3-bar-item w3-button">Productos</a>
              <a href="#contact" class="w3-bar-item w3-button">Contactanos</a>
            </div>
          </div>
        </div>

        <!-- Header -->
        <div class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
          <img class="w3-image " src="<?php echo PATH_IMG."portada.jpg"; ?>" alt="portada" width="1600" height="800">
          <div class="w3-display-bottomleft w3-padding-large w3-opacity">
            <img src="<?php echo PATH_IMG."logo.jpg"; ?>" alt="Logo" class="w3-xxlarge logo">
          </div>
        </div>

        <!-- Page content -->
        <div class="w3-content" style="max-width:1100px">

          <!-- About Section -->
          <div class="w3-row w3-padding-64" id="about">
            <div class="w3-col m6 w3-padding-large w3-hide-small">
             <img src="<?=PATH_IMG."logo.jpg" ?>" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="600" height="750">
            </div>

            <div class="w3-col m6 w3-padding-large">
              <h1 class="w3-center">Sobre Nosotros</h1><br>
              <p class="w3-large"><?= $info->nosotros ?> </p>
              </div>
          </div>

          <hr>

          <!-- Menu Section -->
          <div class="w3-row w3-padding-64" id="menu">
              <h1 class="w3-center">Productos</h1><br>          
              <div class="w3-content w3-display-container">
                  <?php 
                    while ($row = mysqli_fetch_array($publicidad)) {
                        echo '<div class="w3-display-container mySlides">
                                    <img src="'.PATH_IMG.$row['imagen'].'" style="width:100%">
                                    <div class="w3-display-topleft w3-large w3-container w3-padding-16 w3-black">Nombre: '.$row['nombre'].'  Precio:'. $row["precio"].'</div>
                                  </div>';
                    }
                  ?>
              </div>
          </div>
          
          <hr>

          <!-- Contact Section -->
          <div class="w3-container w3-padding-64" id="contact">
            <h1>Contactanos</h1><br>
            <p><?= $info->contacto?></p>
            <form action="<?= FOLDER_PATH."/Inicio/agregar"?>" target="_blank">
              <p><input class="w3-input w3-padding-16" type="text" placeholder="nombre" required name="nombre"></p>
              <p><input class="w3-input w3-padding-16" type="email" placeholder="correo" required name="correo"></p>
              <p><input class="w3-input w3-padding-16" type="text" placeholder="telefono" required name="telefono" ></p>
              <p><input class="w3-input w3-padding-16" type="text" placeholder="Mensaje" required name="mensaje"></p>
              <p><button class="w3-button w3-light-grey w3-section" type="submit">Enviar</button></p>
            </form>
          </div>

        <!-- End page content -->
        </div>

        <!-- Footer -->
        <footer class="w3-center w3-light-grey w3-padding-32">
            
        </footer>
    </body>
</html>


