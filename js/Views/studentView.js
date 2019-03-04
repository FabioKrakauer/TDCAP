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
            coursesList += `<option value="${data.id}">${data.name}</option>`
        })

        companyData.forEach(function (data) {
            companiesList += `<option value="${data.id}">${data.name}</option>`
        })

        var content = `
            <h1 class="h3 text-white text-center p-1 mb-4">Adicionar Aluno</h1>
            <form action="../controller/newStudent.php" method="post" onsubmit="return validatePassword()">
                <div class="container row mx-auto">
                    <div class="form-group col-12">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome do aluno" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-mail do aluno" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="student-course">Curso:</label>
                        <select class="custom-select" id="student-course" name="course">
                            <option value="" selected disabled>Curso...</option>
                            ${coursesList}
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="student-company">Empresa:</label>
                        <select class="custom-select" id="student-company" name="company" required>
                            <option value="" selected disabled>Empresa...</option>
                            ${companiesList}
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="password">Senha:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="password-conf">Confirme a senha:</label>
                        <input type="password" name="password-conf" id="password-conf" class="form-control" placeholder="Confirme a senha" required>
                    </div>
                    <div class="form-group col-12">
                        <label>É administrador?</label>
                        <div class="ml-4">
                            <input class="form-check-input" type="radio" name="adminRadio" id="adminTrue" value="1">
                            <label class="form-check-label" for="adminTrue">
                                Sim
                            </label>
                        </div>
                        <div class="ml-4">
                            <input class="form-check-input" type="radio" name="adminRadio" id="adminFalse" value="0" checked>
                            <label class="form-check-label" for="adminFalse">
                                Não
                            </label>
                        </div>
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
                    courseHasList += `
                    <li class='list-group-item d-flex justify-content-between'>
                        ${courseData[courseId - 1].name}
                        <form action="../controller/removeCourseFromStudent.php" method="post">
                            <input type="hidden" value="${studentData.id}" name="studentId">
                            <input type="hidden" value="${courseId}" name="courseId">
                            <input type="submit" name="action" class="btn btn-sm btn-danger float-right" value="Remover">
                        </form>
                    </li>`
                    console.log(courseData);
                    
                })
            }
            courseData.forEach(function (course) {
                if ($.inArray(course.id, studentData.course) != -1) {
                    return
                }
                courseToList += `<option value="${course.id}">${course.name}</option>`
            })
            addEditContent()
        })

    $.getJSON('http://ramacciotti.org/tdc/api/company.php?company=0', function (companyAPIData) {
        companyData = companyAPIData
    })
        .done(function () {
            companyData.forEach(function (company) {
                if ($.isEmptyObject(studentData.company)) {
                    companyToList += `<option value="" disabled selected>Empresa...</option>`
                } else if (company.id == studentData.company) {
                    companyToList += `<option value="${company.id}" selected>${company.name}</option>`
                } else {
                    companyToList += `<option value="${company.id}">${company.name}</option>`
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
        <form action="../controller/editStudent.php" method="post">
            <div class="row mx-auto">
                <div class="form-group col-12">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" value="${studentData.name}" required>
                </div>
                <div class="form-group col-12">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control" value="${studentData.email}" required>
                </div>
                <div class="form-group col-12">
                    <label for="student-company">Empresa:</label>
                    <select class="custom-select" id="student-company" name="studentCompany" required>
                        ${companyToList}
                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>
                </div>
                <div class="form-group col-12">
                    <label for="password-conf">Confirme a senha:</label>
                    <input type="password" name="password-conf" id="password-conf" class="form-control" placeholder="Confirme a senha" onfocusout="validatePassword()" required>
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
                    <select class="custom-select" id="student-course" name="studentCourse" required>
                        <option value="" selected disabled>Curso...</option>
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