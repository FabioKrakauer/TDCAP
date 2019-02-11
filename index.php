<?php 

require_once 'config.inc.php';
require_once APP_ROOT . "/classes/User.class.php";
require_once APP_ROOT . "/classes/Course.class.php";
require_once APP_ROOT . "/classes/Auth.class.php";

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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
    Olá, <?= $user->getName() ?>
    <h1>Seus cursos:</h1>

    <?php 
        foreach($user->getCourse() as $course){

            ?>
            <!-- LIST ALL USER COURSES -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a href="pages/course.php?course=<?= $course->getID() ?>&slide=inicial">Curso: <?= $course->getName() ?></a></h4>
                    <p class="card-text">Empresa: <?= $course->getCompany()->getName() ?></p>
                    <p class="card-text">Progresso: <?= $user->getCourseProgress($course->getID()) . "%" ?></p>
                    <a href="pages/course.php?course=<?= $course->getID() ?>&slide=inicial" class="btn btn-primary">Abrir</a>
                </div>
            </div>
<?php   }
    ?>
    <!-- FOOTER HERE -->




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>