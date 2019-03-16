<?php 

require_once 'config.inc.php';
require_once APP_ROOT . "/classes/User.class.php";
require_once APP_ROOT . "/classes/Course.class.php";
require_once APP_ROOT . "/classes/Auth.class.php";
require_once APP_ROOT . "/classes/Question.class.php";

global $database;

Auth::isLogged(true, 0);
$user = Auth::user();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Selecione seu curso</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/student.css">
  </head>
  <body>
    <header>
    <div class="d-flex justify-content-between">
      <div class="p-3">
        <a href="index.php">
          <img src="img/logo.gif" alt="">
        </a>
      </div>
      <div class="p-3 text-white d-flex flex-column justify-content-between align-items-end">
        <h6>
          Olá, <?= $user->getName() ?>
        </h6>
        <a href="logout.php?page=1" class="text-white">sair</a>
      </div>
    </div>
    </header>
    <main>
      <h1 class="pl-3 text-white mb-4 h3">Seus cursos:</h1>
      <div class="container">
        <div class="row">
          <?php
              foreach($user->getCourse() as $course){
                  ?>
                  <!-- LIST ALL USER COURSES -->
                  <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-4">
                    <div class="card h-100">
                      <div class="card-body m-1 d-flex flex-column justify-content-between">
                          <h4 class="card-title">
                            <a href="pages/course.php?course=<?= $course->getID() ?>&slide=<?= $course->getInicialSlide()->getID() ?>">
                              <?= $course->getName() ?>
                          </a>
                        </h4>
                          <p class="card-text">Empresa: <?= $course->getCompany()->getName() ?></p>
                          <p class="card-text">Progresso: <?= $user->getCourseProgress($course->getID()) . "%" ?></p>
                          <a href="pages/course.php?course=<?= $course->getID() ?>&slide=<?= $course->getInicialSlide()->getID() ?>" class="open-button btn btn-sm btn-outline-primary">Abrir</a>
                      </div>
                    </div>
                  </div>
      <?php   }
          ?>
        </div>
      </div>
    </main>


    

    <!-- FOOTER HERE -->




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>