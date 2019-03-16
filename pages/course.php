<?php

require_once '../config.inc.php';
require_once APP_ROOT . '/classes/Auth.class.php';
require_once APP_ROOT . '/classes/Course.class.php';

global $database;
Auth::isLogged(true, 0);
$user = Auth::user();

if (isset($_GET["course"]) && isset($_GET["slide"])) {
    $course = new Course($_GET["course"]);
    $slide = new Slide($_GET["slide"]);
    $user->addSlideView($slide);
    ?>

<!doctype html>
<html lang="en">
  <head>
    <title>Curso</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/student.css">
  </head>
  <body>
  <header>
    <div class="top-bar"><h6 class="text-white text-center py-1">Transformando conhecimento em ação e ação em resultado</h6></div>
      <div class="d-flex justify-content-between">
        <div class="p-3">
          <a href="index.php">
            <img src="../img/logo.gif" alt="">
          </a>
        </div>
        <div class="p-3 text-white d-flex flex-column justify-content-between align-items-end">
          <h6>
            Olá, <?=$user->getName()?>
          </h6>
          <a href="logout.php?page=1" class="text-white"><i class="fas fa-sign-out-alt"></i>  Sair</a>
        </div>
      </div>
    </header>
    <main>
      <h1 class="text-white h3 pl-3 pb-1"><?=$course->getName()?><br></h1>
      <div class="d-flex">
        <div class="slides-list">
          <h6>Slides:</h6>
           <ul class="list-group">
             <?php
$fields = $database->getFieldsValues("SELECT `title`, `id` FROM `slides` WHERE `course_id`='" . $course->getID() . "' ORDER BY `orders` ASC");
    foreach ($fields as $row) {
        $id = $row["id"];
        ?>
                 <li class="list-group-item">
                   <a href="course.php?course=<?=$course->getID()?>&slide=<?=$id?>">
                   <?php
if ($user->viewSlide($row["id"])) {
            echo '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>';
        }
        ?>
                   <?=$row["title"]?></a>
                 </li>
           <?php }
    ?>
           </ul>
           <div class="audio-content text-center pt-3 border-top">
            <audio src="http://<?=$slide->getPathAudio()?>"></audio>
            <audio controls="controls">
              <source src="http://<?=$slide->getPathAudio()?>" type="audio/mpeg" />
            </audio>
           </div>

      <?php
}
?>
           <?php
if ($user->getCourseProgress($course->getID()) == 100) {
    if ($user->getUserMakeExam($course->getID()) == false) {
        ?>
          <!-- BUTTON TO USER MAKE EXAM -->
          <form action="exam.php" method="post">
              <input type="hidden" name="course" value="<?=$course->getID()?>">
              <input type="submit" name="action" value="Realizar prova" class="btn btn-success">
          </form>
  <?php
} else {?>

      <!-- ALERT IF USER ALREADY MAKE EXAM! -->
        <div class="alert alert-success col-4" role="alert">
          <strong>Você ja realizou sua prova! Sua nota foi de <?=$user->getUserExamResult($course->getID())?> de 100
            <form action="viewExam.php" method="post">
                <input type="hidden" name="course_id" value="<?=$course->getID()?>">
                <input type="submit" name="action" class="btn btn-success" value="Ver exame">
            </form>
          </strong>
        </div>
    <?php }
}
?>
        </div>
        
        <div class="slide-image-content text-center">
          <img src="http://<?=$slide->getPathImage()?>" alt="<?=$slide->getTitle()?>" class="w-100">
        </div>
      </div>
    </main>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
