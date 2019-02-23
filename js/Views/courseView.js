addCourseView = function () {

    let content = `
                    <h1 class="h3 text-white text-center p-1 mb-4">Adicionar Curso</h1>
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
                                <label for="inicial-name">Slide inicial:</label>
                                <input type="text" name="inicial_name" id="inicial-name" class="form-control mb-1" placeholder="Digite o nome do primeiro slide!">
                                <input type="file" class="form-control-file" id="inicial-slide">
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="end-name">Slide final:</label>
                                <input type="text" name="end_name" id="end-name" class="form-control mb-1" placeholder="Digite o nome do ultimo slide!">
                                <input type="file" class="form-control-file" id="end-slide">
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="inicial-audio">Áudio inicial:</label>
                                <input type="file" class="form-control-file" id="inicial-audio">
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label for="end-audio">Áudio final:</label>
                                <input type="file" class="form-control-file" id="end-audio">
                            </div>
                            <div class="form-group col-12">
                                <input type="submit" name="action" class="btn btn-sm save text-white" value="Salvar">
                            </div>
                        </div>
                    </form>
                `

    $('#dynamic-content').html(content)
}

showCourseView = function (coursesData) {
    let courseList = ``

    coursesData.forEach(function (course) {
        courseList += `<li class="list-group-item">${course.name}<button class="btn btn-outline-primary btn-sm btn-lg-lg float-right" onclick="editCourse(${course.id})">Editar</button></li>`
    })

    let content = `
            <h1 class="h3 text-white text-center p-1 mb-4">Cursos Cadastrados</h1>
            <div class="container">
                <ul class="container list-group list-group-flush">
                    ${courseList}
                </ul>
            </div>
        `

    $('#dynamic-content').html(content)
}

editCourseView = function (courseData) {
    console.log(courseData)
}