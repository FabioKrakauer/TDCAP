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

</head>
<body>
    <header>
        <nav class="navbar navbar-light">
            <a class="navbar-brand" href="#"><img src="../img/logo.gif" alt="logo"></a>
        </nav>
    </header>
    <div class="login-form container mt-5 rounded border p-5">
    <?php
        if(isset($_GET["error"])){ ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_GET["error"] ?></strong>
            </div>
    <?php }
    
    ?>
        <form action="../controller/loginController.php" method="post">
            <input type="hidden" name="admin" value="loginAdmin">
            <div class="form-group">
                <label for="username">E-mail:</label>
                <input type="text" class="form-control" name="email" id="username">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" name="action" id="sendlogin" class="btn btn-primary">Logar</button>
        </form>
    </div>




            <form action="../controller/newStudent.php" method="post">
                <div class="row mx-auto">
                    <div class="form-group col-12">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" id="name" class="form-control" value="${studentData.name}">
                    </div>
                    <div class="form-group col-12">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" value="${studentData.email}">
                    </div>
                    <div class="form-group col-12">
                        <label for="student-company">Empresa:</label>
                        <select class="custom-select" id="student-company" required>
                            ${companyToList}
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="password">Senha:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Senha">
                    </div>
                    <div class="form-group col-12">
                        <label for="password-conf">Confirme a senha:</label>
                        <input type="password" name="password-conf" id="password-conf" class="form-control" placeholder="Confirme a senha">
                    </div>
                    <input type="hidden" value="${studentData.id}" name="studentId">
                    <div class="form-group col-12">
                        <input type="submit" name="action" class="btn btn-sm save text-white" value="Salvar">
                    </div>
                </div>
            </form>
            <h3 class="h4 text-white text-center p-1 mb-4">Cursos</h3>
            <ul class="list-group list-group-flush mb-4">
                ${courseHasList}
            </ul>
            <form action="../controller/addCourseToStudent.php" method="post">
                <input type="hidden" value="${studentData.id}" name="studentId">
                <input type="hidden" value="${courseData.id}" name="courseId">
                <div class="row mx-auto">
                    <div class="form-group col-12">
                        <label for="student-course">Adicionar curso:</label>
                        <select class="custom-select" id="student-course" required>
                            <option value="" selected disabled>Curso...</option>
                            ${courseToList}
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <input type="submit" name="action" class="btn btn-sm save text-white" value="Salvar">
                    </div>
                </div>
            </form>










    <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>