<?php

require_once '../config.inc.php';
require_once APP_ROOT . '/classes/Auth.class.php';
require_once APP_ROOT . '/classes/Course.class.php';

global $database;
Auth::isLogged(true, 0);
$user = Auth::user();
$userID = $user->getID();
if(isset($_POST["course_id"])){ 
    $course = new Course($_POST["course_id"]);
    $courseID = $course->getID();
?>
    <!doctype html>
    <html lang="en">
      <head>
        <title>Ver prova</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      </head>
      <body>

            <h1>Vendo a prova do curso - <b><?= $course->getName() ?></b></h1>

            <?php 
                $questionsAndAnswers = $database->getFieldsValues("SELECT `question_id`,`answer` FROM `user_exam` WHERE `user_id`='$userID' AND `course_id`='$courseID'");
                $questions = 0;
                foreach($questionsAndAnswers as $key => $field){
                    $question = new Question($field["question_id"]);
                    $questions++;
                    ?>

               <!-- FRONT HERE -->
            
            <div class="form-group">
                <p><?= $questions . "- " . $question->getQuestion() ?></p>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="<?= $question->getID() ?>" id="" type="radio" value="1" aria-label="Text for screen reader">
                        <?= $question->getAlternatives()["1"] ?>
                        <?php
                            if($question->getCorrectAlternative() == 1){
                                echo 'ICONE DE CERTO';
                            }else{
                                if($field["answer"] == 1){
                                    echo 'ICONE DE ERRADO';
                                }
                            }
                        ?>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="<?= $question->getID() ?>" id="" type="radio" value="2" aria-label="Text for screen reader">
                        <?= $question->getAlternatives()["2"] ?>
                        <?php
                            if($question->getCorrectAlternative() == 2){
                                echo 'ICONE DE CERTO';
                            }else{
                                if($field["answer"] == 2){
                                    echo 'ICONE DE ERRADO';
                                }
                            }
                        ?>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="<?= $question->getID() ?>" id="" type="radio" value="3" aria-label="Text for screen reader">
                        <?= $question->getAlternatives()["3"] ?>
                        <?php
                            if($question->getCorrectAlternative() == 3){
                                echo 'ICONE DE CERTO';
                            }else{
                                if($field["answer"] == 3){
                                    echo 'ICONE DE ERRADO';
                                }
                            }
                        ?>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="<?= $question->getID() ?>" id="" type="radio" value="4" aria-label="Text for screen reader">
                        <?= $question->getAlternatives()["4"] ?>
                    </label>
                    <?php
                            if($question->getCorrectAlternative() == 4){
                                echo 'ICONE DE CERTO';
                            }else{
                                if($field["answer"] == 4){
                                    echo 'ICONE DE ERRADO';
                                }
                            }
                        ?>
                </div>
            </div>

        <?php  }
            ?>
          
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      </body>
    </html>
<?php } ?>