<?php 

require_once '../config.inc.php';
require_once APP_ROOT . '/classes/Auth.class.php';
require_once APP_ROOT . '/classes/Course.class.php';

global $database;
Auth::isLogged(true, 0);
$user = Auth::user();

if(isset($_GET["course"]) && isset($_GET["slide"])){
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
      <!-- FRONT HERE  -->
      Você esta no curso: <b><?= $course->getName() ?><br>
     Escolha um slide!</b>
      <ul>
        <?php
            $fields = $database->getFieldsValues("SELECT `title`, `id` FROM `slides` WHERE `course_id`='".$course->getID()."' ORDER BY `orders` ASC");
            foreach($fields as $row){
              $id = $row["id"];
            ?>
            <!-- FRONT HERE -->
            <li>
              <a href="course.php?course=<?= $course->getID() ?>&slide=<?= $id ?>">
              <?php 
                if($user->viewSlide($row["id"])){
                  echo '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>';
                }
              ?>
              <?= $row["title"] ?></a>
            </li>
      <?php }
      ?>
      </ul>
      Slide Image: <img src="http://<?= $slide->getPathImage() ?>" alt="<?= $slide->getTitle() ?>" style="width:100px; height:100px">
      Audio: <audio src="http://<?= $slide->getPathAudio() ?>"></audio>
      <audio controls="controls">
        <source src="http://<?= $slide->getPathAudio() ?>" type="audio/mpeg" />
      </audio>
      <?php }
      ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
