<?php

require_once '../config.inc.php';
require_once APP_ROOT . '/classes/Auth.class.php';
require_once APP_ROOT . '/classes/Course.class.php';

global $database;
Auth::isLogged(true, 0);
$user = Auth::user();
if(isset($_POST["course"])){ 
    $course = new Course($_POST["course"]);
    ?>

    <p>Realizar prova do curso <b><?= $course->getName() ?></b></p>
    <form action="../controller/examValidade.php" method="post">
        <input type="hidden" name="courseID" value="<?= $course->getID() ?>">

        <!-- JAVA SCRIPT PLAY SECONDS TIME -->
        <input type="hidden" name="time" value="2100">
    <?php
        $questions = 0; 
        foreach($course->getQuestions() as $question){
            $questions++;
            ?>

            <!-- FRONT HERE -->
            
            <div class="form-group">
                <p><?= $questions . "- " . $question->getQuestion() ?></p>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="<?= $question->getID() ?>" id="" type="radio" value="1" aria-label="Text for screen reader">
                        <?= $question->getAlternatives()["1"] ?>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="<?= $question->getID() ?>" id="" type="radio" value="2" aria-label="Text for screen reader">
                        <?= $question->getAlternatives()["2"] ?>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="<?= $question->getID() ?>" id="" type="radio" value="3" aria-label="Text for screen reader">
                        <?= $question->getAlternatives()["3"] ?>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="<?= $question->getID() ?>" id="" type="radio" value="4" aria-label="Text for screen reader">
                        <?= $question->getAlternatives()["4"] ?>
                    </label>
                </div>
            </div>
    <?php }
    ?>
    <input type="submit" name="action" value="Finalizar" class="btn btn-success">
    </form>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
<?php }
?>