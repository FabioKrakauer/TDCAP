$('#admin-list li').on('click', function() {
    $('#admin-list li').removeClass('active-content')
    $(this).addClass('active-content')

    let category = $(this).html().replace(' ', '').charAt(0).toLowerCase() + $(this).html().replace(' ', '').substr(1)

    let adicionarEmpresa = `
        <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
        <form action="../controller/newCompany.php" method="post">
            <div class="container row">
                <div class="form-group col-12">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome da empresa">
                </div>
                <div class="form-group col-12">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ da empresa">
                </div>
                <div class="form-group col-12">
                    <label for="adress">Endereço:</label>
                    <input type="text" name="adress" id="adress" class="form-control" placeholder="Endereço da empresa">
                </div>
                <div class="form-group col-12">
                    <label for="telephone">Telefone:</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Telefone da empresa">
                </div>
                <div class="form-group col-12">
                    <label for="site">Site:</label>
                    <input type="text" name="site" id="site" class="form-control" placeholder="Site da empresa">
                </div>
                <div class="form-group col-12">
                    <label for="contact">Contato do responsável:</label>
                    <input type="text" name="contact" id="contact" class="form-control" placeholder="Contato do responsável">
                </div>
                <div class="form-group col-12">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail do responsável">
                </div>
                <div class="form-group col-12">
                    <input type="submit" name="action" class="btn save text-white" value="Salvar">
                </div>
            </div>
        </form>
    `

    let empresasCadastradas = `
        <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
        <div class="container">
            <ul class="container list-group list-group-flush">
                <li class="list-group-item">Empresa 000</li>
                <li class="list-group-item">Empresa abc</li>
                <li class="list-group-item">Empresa 123</li>
                <li class="list-group-item">Empresa xyz</li>
            </ul>
        </div>
    `

    let adicionarAluno = `
        <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
        <form action="../controller/newStudent.php" method="post">
            <div class="container row">
                <div class="form-group col-12">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome do aluno">
                </div>
                <div class="form-group col-12">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail do aluno">
                </div>
                <div class="form-group col-12">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Senha">
                </div>
                <div class="form-group col-12">
                    <label for="password-conf">Confirme a senha:</label>
                    <input type="password" name="password-conf" id="password-conf" class="form-control" placeholder="Confirme a senha">
                </div>
                <div class="form-group col-12">
                    <input type="submit" name="action" class="btn save text-white" value="Salvar">
                </div>
            </div>
        </form>
    `

    let alunosCadastrados = `
        <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
        <div class="container">
            <ul class="container list-group list-group-flush">
                <li class="list-group-item">Aluno 1</li>
                <li class="list-group-item">Aluno 2</li>
                <li class="list-group-item">Aluno 3</li>
                <li class="list-group-item">Aluno 4</li>
            </ul>
        </div>
    `

    let adicionarCursos = `
        <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
        <form action="../controller/newCourse.php" method="post">
            <div class="container row">
                <div class="form-group col-12">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome do curso">
                </div>
                <div class="form-group col-12">
                    <input type="submit" name="action" class="btn save text-white" value="Salvar">
                </div>
            </div>
        </form>
    `

    let cursosCadastrados = `
        <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
        <div class="container">
            <ul class="container list-group list-group-flush">
                <li class="list-group-item">Curso 1</li>
                <li class="list-group-item">Curso 2</li>
                <li class="list-group-item">Curso 3</li>
                <li class="list-group-item">Curso 4</li>
            </ul>
        </div>
    `

    let verRelatório = `
        <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
        <div class="container">
            <ul class="container list-group list-group-flush">
                <li class="list-group-item">Relatorio 1</li>
                <li class="list-group-item">Relatorio 2</li>
                <li class="list-group-item">Relatorio 3</li>
                <li class="list-group-item">Relatorio 4</li>
            </ul>
        </div>
    `
    
    switch(category){
        case 'adicionarEmpresa': 
            $('#dynamic-content').html(adicionarEmpresa)
            break
        case 'empresasCadastradas':
            $('#dynamic-content').html(empresasCadastradas)
            break
        case 'adicionarAluno':
            $('#dynamic-content').html(adicionarAluno)
            break
        case 'alunosCadastrados':
        $('#dynamic-content').html(alunosCadastrados)
            break
        case 'adicionarCursos':
            $('#dynamic-content').html(adicionarCursos)
            break
        case 'cursosCadastrados':
            $('#dynamic-content').html(cursosCadastrados)
            break
        case 'verRelatório':
            $('#dynamic-content').html(verRelatório)
            break
    }
})