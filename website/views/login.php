<?php include_once 'head.php'; ?>

<body class="login-body">
    <div class="login-box">
      <img src="<?php echo PATH_IMG."logo.jpg" ?>" class="avatar" alt="Avatar Image">
      <h1>Login Here</h1>
      <form method="POST" action="<?= FOLDER_PATH.'/Admin/signin' ?>">
        <!-- USERNAME INPUT -->
        <label for="username">Correo</label>
        <input type="text" placeholder="Ingrese correo" name="correo" required >
        <!-- PASSWORD INPUT -->
        <label for="password">Contraseñia</label>
        <input type="password" placeholder="Ingrese contraseña" name="contrasenia" required>
        <input type="submit" value="Log In">
        <a href="#">Lost your Password?</a><br>
        <a href="#">Don't have An account?</a>
      </form>
     <?php 
        if (!empty($error)){
            echo "<div class='alert alert-danger alert-box'> <p class='alert-text'>{$error}</p> </div>";
        }
        ?>
    </div>
</body>

</html>
