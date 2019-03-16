<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TDC - Educação Corporativa</title>

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>
    <header>
        <div class="d-flex justify-content-between">
            <div class="p-3">
                <a href="index.php">
                <img src="../img/logo.gif" alt="logo">
                </a>
            </div>
            <div class="sub-title d-flex align-items-center">
                <h6 class="text-white text-center mr-4">Transformando conhecimento em ação e ação em resultado</h6>
            </div>
        </div>
    </header>
    <main>
        <h1 class="text-white p-2 h5 text-center">Seja bem vindo. Faça login para entrar.</h1>
        <div class="login-form container mt-5">
        <?php
            if(isset($_GET["error"])){ ?>
                <div class="alert alert-danger" role="alert">
                    <strong><?= $_GET["error"] ?></strong>
                </div>
        <?php }
        
        ?>
            <form action="../controller/loginController.php" method="post" class="col-10 col-md-6 mx-auto p-3 rounded border">
                <input type="hidden" name="admin" value="loginAdmin">
                <div class="form-group">
                    <label for="username">E-mail:</label>
                    <input type="text" class="form-control" name="email" id="username" placeholder="Digite seu e-mail">
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Insira sua senha">
                </div>
                <button type="submit" name="action" id="sendlogin" class="btn btn-sm btn-primary">Logar</button>
            </form>
        </div>
    </main>

    <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>