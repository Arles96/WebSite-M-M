<style>
    body {
        font-family: "Times New Roman", Georgia, Serif;
    }
    
    h1,h2,h3,h4,h5,h6 {
        font-family: "Playfair Display";
        letter-spacing: 5px;
    }
    
    .login-body {
        margin: 0;
        padding: 0;
        background: url("<?php echo PATH_IMG."fondo.jpg"; ?>") no-repeat center top;
        background-size: cover;
        font-family: sans-serif;
        height: 100vh;
    }
    
    .logo {
        width: 150px;
        height: 160px;
    }
    
    .login-box {
        width: 320px;
        height: 420px;
        background: #000;
        color: #fff;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
        box-sizing: border-box;
        padding: 70px 30px;
      }

      .login-box .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        position: absolute;
        top: -50px;
        left: calc(50% - 50px);
      }

      .login-box h1 {
        margin: 0;
        padding: 0 0 20px;
        text-align: center;
        font-size: 22px;
      }

      .login-box label {
        margin: 0;
        padding: 0;
        font-weight: bold;
        display: block;
      }

      .login-box input {
        width: 100%;
        margin-bottom: 20px;
      }

      .login-box input[type="text"], .login-box input[type="password"] {
        border: none;
        border-bottom: 1px solid #fff;
        background: transparent;
        outline: none;
        height: 40px;
        color: #fff;
        font-size: 16px;
      }

      .login-box input[type="submit"] {
        border: none;
        outline: none;
        height: 40px;
        background: #b80f22;
        color: #fff;
        font-size: 18px;
        border-radius: 20px;
      }

      .login-box input[type="submit"]:hover {
        cursor: pointer;
        background: #ffc107;
        color: #000;
      }

      .login-box a {
        text-decoration: none;
        font-size: 12px;
        line-height: 20px;
        color: darkgrey;
      }

      .login-box a:hover {
        color: #fff;
      }
      
      .alert-text {
          font-size: 12px;
      }
      
      .alert-box {
          margin: 0;
          padding: 0;
          width: 100% ;
          height: 20px;
      }
      
      .menu {
          background: #F44336;
          color : white;
          height: 100vh;
          text-align: center;
      }
      
      .text-center{
          text-align: center;
      }
      
      .menu-text {
          font-size: 32px;
          width: 100% !important;
      }
      
      .menu-bar {
          margin: 50px auto;
      }
      
      .title {
          font-size: 64px !important;
      }
      
      .divition {
          width: 50px;
          border: 5px solid red;
      }
      
      .text-principal {
          font-size: 16px;
      }
      
</style>

