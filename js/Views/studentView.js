addStudentView = function () {
    var coursesList = ``
    var companiesList = ``
    var courseData
    var companyData


    $.getJSON('http://ramacciotti.org/tdc/api/course.php?course=0', function (data) {

        courseData = data
    })
        .done(function () {

            addContent()
        })
        .fail(function () {
            console.log('curso erro')
        })

    $.getJSON('http://ramacciotti.org/tdc/api/company.php?company=0', function (data) {

        companyData = data
    })
        .done(function () {
            addContent()
        })
        .fail(function () {
            console.log('empresa erro')
        })

    var addContent = function () {
        if (courseData == undefined || companyData == undefined) {
            return
        }

        courseData.forEach(function (data) {
            coursesList += `<option value="${data.name}">${data.name}</option>`
        })

        companyData.forEach(function (data) {
            companiesList += `<option value="${data.name}">${data.name}</option>`
        })

        var content = `
            <h1 class="h3 text-white text-center p-1 mb-4">Adicionar Aluno</h1>
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
                            ${coursesList}
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="student-company">Empresa:</label>
                        <select class="custom-select" id="student-company">
                            <option selected disabled>Empresa...</option>
                            ${companiesList}
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
                        <input type="submit" name="action" class="btn btn-sm save text-white" value="Salvar">
                    </div>
                </div>
            </form>
        `

        $('#dynamic-content').html(content)
    }
}

showStudentView = function (data) {
    var studentsList = ``

    data.forEach(function (data) {
        studentsList += `
            <li class='list-group-item'>
                ${data.name}
                <button class='btn btn-outline-primary btn-sm btn-lg-lg float-right' onclick="editStudent(${data.id})">
                    Editar
                </button>
                <button class="btn btn-outline-primary btn-sm btn-lg-lg mr-2 float-right" onclick="studentReport(${data.id})">
                    Relatório
                </button>
            </li>
        `
    })

    var content = ` 
        <h1 class="h3 text-white text-center p-1 mb-4">Alunos Cadastrados</h1>
        <div class="container">
            <ul class="container list-group list-group-flush">
                ${studentsList}
            </ul>
        </div>
    `

    $('#dynamic-content').html(content)
}

editStudentView = function (studentData) {
    let courseHasList = ``
    let courseData //lista de todos os cursos com dados
    let companyData
    let courseToList = ``
    let companyToList = ``


    $.getJSON('http://ramacciotti.org/tdc/api/course.php?course=0', function (courseAPIData) {
        courseData = courseAPIData
    })
        .done(function () {
            if (!($.isEmptyObject(studentData.course))) {
                studentData.course.forEach(function (courseId) {
                    courseHasList += `<li class='list-group-item'>${courseData[courseId - 1].name}<button class="btn btn-sm btn-danger float-right">Remover</button></li>`
                })
            }
            courseData.forEach(function (course) {
                if ($.inArray(course.id, studentData.course) != -1) {
                    return
                }
                courseToList += `<option value="${course.name}">${course.name}</option>`
            })
            addEditContent()
        })

    $.getJSON('http://ramacciotti.org/tdc/api/company.php?company=0', function (companyAPIData) {
        companyData = companyAPIData
    })
        .done(function () {
            companyData.forEach(function (company) {
                if($.isEmptyObject(studentData.company)){
                    companyToList += `<option disabled selected>Empresa...</option>`
                }else if(company.id == studentData.company){
                    companyToList += `<option value="${company.name}" selected>${company.name}</option>`
                }else{
                    companyToList += `<option value="${company.name}">${company.name}</option>`
                }
            })
            addEditContent()
        })

    const addEditContent = function () {
        if (courseData == undefined || companyData == undefined) {
            return
        }
        var content = `
        <h1 class="h3 text-white text-center p-1 mb-4">Editar Aluno</h1>
        <div class="container">
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
                        <select class="custom-select" id="student-company">
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
                <div class="row mx-auto">
                    <div class="form-group col-12">
                        <label for="student-course">Adicionar curso:</label>
                        <select class="custom-select" id="student-course">
                            <option selected disabled>Curso...</option>
                            ${courseToList}
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <input type="submit" name="action" class="btn btn-sm save text-white" value="Salvar">
                    </div>
                </div>
            </form>
        `
        $('#dynamic-content').html(content)
    }
}

reportView = function (data) {
    console.log(data)
    var content = `
        <h1 class="h3 text-white text-center p-1 mb-4">Relatório</h1>
        <div class="container">
            <ul class="list-group list-group-flush mb-4">
                <li class='list-group-item'>...</li>
                <li class='list-group-item'>...</li>
                <li class='list-group-item'>...</li>
            </ul>
        </div>
        `
    $('#dynamic-content').html(content)
}