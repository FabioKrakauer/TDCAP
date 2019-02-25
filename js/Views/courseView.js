addCourseView = function () {
    var companiesList = ``
    var companyData

    $.getJSON('http://ramacciotti.org/tdc/api/company.php?company=0', function (data) {

        companyData = data
    })
        .done(function () {
            addContent()
        })
        .fail(function () {
            console.log('empresa erro')
        })

    addContent = function () {

        companyData.forEach(function (data) {
            companiesList += `<option value="${data.id}">${data.name}</option>`
        })

        let content = `
                        <h1 class="h3 text-white text-center p-1 mb-4">Adicionar Curso</h1>
                        <form action="../controller/newCourse.php" method="post" enctype="multipart/form-data">
                            <div class="container row mx-auto">
                                <div class="form-group col-12">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome do curso" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="student-company">Empresa:</label>
                                    <select class="custom-select" name="company" id="student-company" required>
                                        <option selected disabled value="">Empresa...</option>
                                        ${companiesList}
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="inicial-name">Slide inicial:</label>
                                    <div class="input-group">
                                        <input type="text" name="inicial_name" id="inicial-name" class="form-control col-9"
                                            placeholder="Digite o nome do primeiro slide!" required>
                                        <label for="end-slide" class="form-control btn btn-outline-primary col-3">Carregar slide inicial</label>
                                        <input type="file" name="inicial_slide" class="form-control-file" id="inicial-slide" required hidden>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="end-name">Slide final:</label>
                                    <div class="input-group">
                                        <input type="text" name="end_name" id="end-name" class="form-control col-9"
                                            placeholder="Digite o nome do ultimo slide!" required>
                                        <label for="end-slide" class="form-control btn btn-outline-primary col-3">Carregar slide final</label>
                                        <input type="file" name="end_slide" class="form-control-file" id="end-slide" required hidden>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="inicial-audio">Áudio inicial:</label>
                                    <div>
                                        <label for="end-slide" class="btn btn-outline-primary">Carregar áudio inicial</label>
                                        <input type="file" name="inicial_audio" class="form-control-file" id="inicial-audio" required hidden>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="end-audio">Áudio final:</label>
                                    <div>
                                        <label for="end-slide" class="btn btn-outline-primary">Carregar áudio final</label>
                                        <input type="file" name="end-audio" class="form-control-file" id="end-audio" required hidden>
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