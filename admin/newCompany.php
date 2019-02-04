<!doctype html>
<html lang="en">
  <head>
    <title>Área administrativa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style1.css">
  
  </head>
  <body>
      <div class="intro row">
          <div class="right bg-primary col-12 col-sm-5">
        <div class="logo d-flex justify-content-center text-justify">
            <img src="../img/logo.gif" alt="Logo" class="mt-4 ml-4">
            <p class="text-white text-white text-center font-size-14 mt-4 ml-2">Transformando Conhecimento em ação e ação em resultado</p>
        </div>
        <div class="nav mt-5">
            <ul class="col-12 no-padding">
                <li class="nav-item text-center active">
                    <a href="/admin/newCompany.php" class="text-white navigation">ADICIONAR EMPRESA</a>
                </li>
                <li class="nav-item text-center rounded">
                    <a href="/admin/viewCompanys.php" class="text-white navigation">EMPRESA CADASTRADAS</a>
                </li>
                <li class="nav-item text-center">
                    <a href="/admin/viewCompanys.php" class="text-white navigation">ADICIONAR ALUNO</a>
                </li>
                <li class="nav-item text-center">
                    <a href="/admin/viewCompanys.php" class="text-white navigation">ALUNOS CADASTRADOS</a>
                </li> 
                <li class="nav-item text-center">
                    <a href="/admin/viewCompanys.php" class="text-white navigation">ADICIONAR CURSOS</a>
                </li>
                <li class="nav-item text-center">
                    <a href="/admin/viewCompanys.php" class="text-white navigation">CURSOS CADASTRADOS</a>
                </li>
                <li class="nav-item text-center">
                    <a href="/admin/viewCompanys.php" class="text-white navigation">VER RELATORIO</a>
                </li>
            </ul>
        </div>
      </div>
      <div class="right col-12 col-sm-7">
          <p class="text-primary text-right mr-5 font-size-16">Olá, Alberto Perazzo</p>
          <div class="title d-flex align-items-center">
              <h1 class="text-white font-size-20 ml-5">Adicionar Empresa</h1>
          </div>
          <form action="../controller/newCompany.php" method="post">
                <div class="row justify-content-center">
                    <div class="form-group col-11">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome da empresa">
                    </div>
                    <div class="form-group col-11">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ da empresa">
                    </div>
                    <div class="form-group col-11">
                        <label for="adress">Endereço:</label>
                        <input type="text" name="adress" id="adress" class="form-control" placeholder="Endereço da empresa">
                    </div>
                    <div class="form-group col-11">
                        <label for="telephone">Telefone:</label>
                        <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Telefone da empresa">
                    </div>
                    <div class="form-group col-11">
                        <label for="site">Site:</label>
                        <input type="text" name="site" id="site" class="form-control" placeholder="Site da empresa">
                    </div>
                    <div class="form-group col-11">
                        <label for="contact">Contato do responsável:</label>
                        <input type="text" name="contact" id="contact" class="form-control" placeholder="Contato do responsável">
                    </div>
                    <div class="form-group col-11">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail do responsável">
                    </div>          
                </div>
                <input type="submit" name="action" class="btn btn-primary ml-5" value="Salvar">
          </form>
      </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>