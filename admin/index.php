<?php 

require_once '../config.inc.php';
require_once APP_ROOT . "/classes/User.class.php";
require_once APP_ROOT . "/classes/Auth.class.php";


Auth::isLogged(true, 1);
$user = Auth::user();
if(!$user->isAdmin()){
    echo "<h1>Somente administradores podem acessar esta pagina!";
    die();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TDC - Educação Corporativa</title>

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
    <header class="text-white">
        <div class="row w-100 py-3 mx-auto">
            <div class="col-6">
                <img src="../img/logo.gif" alt="">
            </div>
            <div class="col-6">
                <h3 class="h6 text-center">Transformando Conhecimento em ação e ação em resultado</h3>
            </div>
        </div>
        <nav>
            <ul class="text-center py-3 mb-0 border-top border-bottom border-secondary" id="admin-list">
                <li class="py-1" onclick="addCompany()">Adicionar Empresa</li>
                <li class="py-1" onclick="showCompany()">Empresas Cadastradas</li>
                <li class="py-1" onclick="addStudent()">Adicionar Aluno</li>
                <li class="py-1" onclick="showStudent()">Alunos Cadastrados</li>
                <li class="py-1" onclick="addCourse()">Adicionar Cursos</li>
                <li class="py-1" onclick="showCourse()">Cursos Cadastrados</li>
            </ul>
        </nav>
    </header>
    <p id="json"></p>
    <main>
        <div class="hello">
            <h6 class="mr-4 pb-2 pt-4 mb-0 text-white">Olá, <span><?= $user->getName() ?></span></h6>
        </div>
        <div class="" id="dynamic-content">
            <h1 class="h3 text-white text-center py-1">TDC</h1>
            <div id="form"></div>
        </div>
    </main>

    <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/Views/companyView.js"></script>
</body>
</html>