<?php include_once 'head.php'; ?>

<body class="login-body">
    <div class="login-box">
      <img src="<?php echo PATH_IMG."logo.jpg" ?>" class="avatar" alt="Avatar Image">
      <h1>Login Here</h1>
      <form>
        <!-- USERNAME INPUT -->
        <label for="username">Correo</label>
        <input type="text" placeholder="Ingrese correo">
        <!-- PASSWORD INPUT -->
        <label for="password">Contraseñia</label>
        <input type="password" placeholder="Ingrese contraseña">
        <input type="submit" value="Log In">
        <a href="#">Lost your Password?</a><br>
        <a href="#">Don't have An account?</a>
      </form>
    </div>
</body>

</html>
