<?php

require_once '../config.inc.php';
require_once APP_ROOT . '/classes/Auth.class.php';
require_once APP_ROOT . '/classes/Course.class.php';

global $database;
Auth::isLogged(true, 0);
$user = Auth::user();
$userID = $user->getID();
if (isset($_POST["course_id"])) {
    $course = new Course($_POST["course_id"]);
    $courseID = $course->getID();
    ?>
    <!doctype html>
    <html lang="pt-br">
      <head>
        <title>Ver prova</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../img/logo.gif">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/student.css">
      </head>
      <body>
      <?php include 'header.php'?>
      <main>
        <h1 class="text-white h3 pl-3 pb-1">Vendo a prova do curso - <?=$course->getName()?></h1>
        <div class="container mt-5">
            <?php
    $questionsAndAnswers = $database->getFieldsValues("SELECT `question_id`,`answer` FROM `user_exam` WHERE `user_id`='$userID' AND `course_id`='$courseID'");
        $questions = 0;
        foreach ($questionsAndAnswers as $key => $field) {
            $question = new Question($field["question_id"]);
            $questions++;
            ?>

                <!-- FRONT HERE -->
            <div class="form-group">
                <p class="font-weight-bold"><?=$questions . "- " . $question->getQuestion()?></p>
                <div class="form-check">
                    <label class="form-check-label">
                        <input disabled class="form-check-input" name="<?=$question->getID()?>" id="" type="radio" value="1" aria-label="Text for screen reader">
                        <?=$question->getAlternatives()["1"]?>
                        <?php
    if ($question->getCorrectAlternative() == 1) {
                echo '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>';
            } else {
                if ($field["answer"] == 1) {
                    echo '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>';
                }
            }
            ?>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input disabled class="form-check-input" name="<?=$question->getID()?>" id="" type="radio" value="2" aria-label="Text for screen reader">
                        <?=$question->getAlternatives()["2"]?>
                        <?php
    if ($question->getCorrectAlternative() == 2) {
                echo '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>';
            } else {
                if ($field["answer"] == 2) {
                    echo '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>';
                }
            }
            ?>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input disabled class="form-check-input" name="<?=$question->getID()?>" id="" type="radio" value="3" aria-label="Text for screen reader">
                        <?=$question->getAlternatives()["3"]?>
                        <?php
    if ($question->getCorrectAlternative() == 3) {
                echo '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>';
            } else {
                if ($field["answer"] == 3) {
                    echo '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>';
                }
            }
            ?>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input disabled class="form-check-input" name="<?=$question->getID()?>" id="" type="radio" value="4" aria-label="Text for screen reader">
                        <?=$question->getAlternatives()["4"]?>
                    </label>
                    <?php
    if ($question->getCorrectAlternative() == 4) {
                echo '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>';
            } else {
                if ($field["answer"] == 4) {
                    echo '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>';
                }
            }
            ?>
                </div>
                <hr>
            </div>

        <?php }
        ?>
        </div>
        <div class="container">
            <a href="<?= "../pages/course.php?course=".$courseID."&slide=".$course->getInicialSlide()->getID() ?>"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
      </main>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      </body>
    </html>
<?php }?>