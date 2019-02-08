
var companies = []
$.getJSON('http://localhost:8888/tdcap/js/teste.json', function (data) {
    $(data.companies).each(function (index, company) {
        companies.push(company)
    })
    // companies.forEach((index, data) => console.log(data.name))

    $('#admin-list li').on('click', function () {
        $('#admin-list li').removeClass('active-content')
        $(this).addClass('active-content')

        let category = $(this).html().replace(' ', '').charAt(0).toLowerCase() + $(this).html().replace(' ', '').substr(1)

        let adicionarEmpresa = `
                <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
                <form action="../controller/newCompany.php" method="post">
                    <div class="container row mx-auto">
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
        listCompanies = ``
        companies.forEach(function (data, index) {
            listCompanies += `<li class='list-group-item'>${data.name}<button class='btn btn-outline-primary btn-sm btn-lg-lg float-right'>Editar</button></li>`
        })
        let empresasCadastradas = `
            <h1 class='h3 text-white text-center p-1 mb-4'>${$(this).html()}</h1>
            <div class='container'><ul class='container list-group list-group-flush'>
                <ul>
                    ${listCompanies}
                </ul>
            </div>
        `


        let adicionarAluno = `
                <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
                <form action="../controller/newStudent.php" method="post">
                    <div class="container row mx-auto">
                        <div class="form-group col-12">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nome do aluno">
                        </div>
                        <div class="form-group col-12">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail do aluno">
                        </div>
                        <div class="form-group col-12">
                            <label for="student-course">Curso:</label>
                            <select class="custom-select" id="student-course">
                                <option selected disabled>Curso...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="student-company">Empresa:</label>
                            <select class="custom-select" id="student-company">
                                <option selected disabled>Empresa...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
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
                        <li class="list-group-item">Aluno 1<button class="btn btn-outline-primary btn-sm btn-lg-lg float-right">Editar</button></li>
                        <li class="list-group-item">Aluno 2<button class="btn btn-outline-primary btn-sm btn-lg-lg float-right">Editar</button></li>
                        <li class="list-group-item">Aluno 3<button class="btn btn-outline-primary btn-sm btn-lg-lg float-right">Editar</button></li>
                        <li class="list-group-item">Aluno 4<button class="btn btn-outline-primary btn-sm btn-lg-lg float-right">Editar</button></li>
                    </ul>
                </div>
            `

        let adicionarCursos = `
                <h1 class="h3 text-white text-center p-1 mb-4">${$(this).html()}</h1>
                <form action="../controller/newCourse.php" method="post">
                    <div class="container row mx-auto">
                        <div class="form-group col-12">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nome do curso">
                        </div>
                        <div class="form-group col-12">
                            <label for="student-company">Empresa:</label>
                            <select class="custom-select" id="student-company">
                                <option selected disabled>Empresa...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="inicial-slide">Slide inicial:</label>
                            <input type="file" class="form-control-file" id="inicial-slide">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="inicial-audio">Áudio inicial:</label>
                            <input type="file" class="form-control-file" id="inicial-audio">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="end-slide">Slide final:</label>
                            <input type="file" class="form-control-file" id="end-slide">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="end-audio">Áudio final:</label>
                            <input type="file" class="form-control-file" id="end-audio">
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
                        <li class="list-group-item">Curso 1<button class="btn btn-outline-primary btn-sm btn-lg-lg float-right">Editar</button></li>
                        <li class="list-group-item">Curso 2<button class="btn btn-outline-primary btn-sm btn-lg-lg float-right">Editar</button></li>
                        <li class="list-group-item">Curso 3<button class="btn btn-outline-primary btn-sm btn-lg-lg float-right">Editar</button></li>
                        <li class="list-group-item">Curso 4<button class="btn btn-outline-primary btn-sm btn-lg-lg float-right">Editar</button></li>
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

        switch (category) {
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
})


