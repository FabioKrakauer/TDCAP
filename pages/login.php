<?php 

require_once '../config.inc.php';
require_once APP_ROOT . '/classes/Auth.class.php';

if(Auth::isLogged(false)){
    //REDIRECT TO INDEX
    exit(header("Location: ../index.php"));
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/student.css">
  </head>
  <body>
  <header>
    <div class="d-flex justify-content-between">
      <div class="p-3">
        <a href="index.php">
          <img src="../img/logo.gif" alt="">
        </a>
      </div>
      <div class="sub-title d-flex align-items-center">
        <h6 class="text-white text-center mr-4">Transformando conhecimento em ação e ação em resultado</h6>
      </div>
    </div>
  </header>

  <?php

        if(isset($_GET["error"])){
            $error =  $_GET["error"];
            ?>
            <!-- ERROR MESSAGE! HTML SUPPORT -->
            
            <!-- PRINT ERROR BELOW -->
            <?= $error ?>
<?php   }
    ?>
    <main>
      <h1 class="text-white p-2 h5 text-center">Seja bem vindo. Faça login para entrar.</h1>
      <div class="container mt-5">
        <form action="../controller/loginController.php" method="post" class="col-10 col-md-6 mx-auto p-3 rounded border">
          <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Digite seu e-mail">
          </div>
          <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" id="password" class="form-control" placeholder="Insira sua senha">
          </div>
          <div class="form-group">
            <input type="submit" name="action" value="Logar" class="btn btn-sm btn-primary mt-3">
          </div>
        </form>
      </div>
    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>