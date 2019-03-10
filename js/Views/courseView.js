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
                                        <label id="label-inicial-slide" for="inicial-slide" class="form-control btn btn-outline-primary col-3">
                                            Carregar
                                        </label>
                                        <input type="file" name="inicial_slide" class="form-control-file" id="inicial-slide" onchange="validateInicialSlide()" accept="image/*" required hidden>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="end-name">Slide final:</label>
                                    <div class="input-group">
                                        <input type="text" name="end_name" id="end-name" class="form-control col-9"
                                            placeholder="Digite o nome do ultimo slide!" required>
                                        <label id="label-end-slide" for="end-slide" class="form-control btn btn-outline-primary col-3">Carregar</label>
                                        <input type="file" name="end_slide" class="form-control-file" id="end-slide" onchange="validateEndSlide()" accept="image/*" required hidden>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="inicial-audio">Áudio inicial:</label>
                                    <div>
                                        <label id="label-inicial-audio" for="inicial-audio" class="btn btn-outline-primary">Carregar áudio inicial</label>
                                        <input type="file" name="inicial_audio" class="form-control-file" id="inicial-audio" onchange="validateInicialAudio()" accept="audio/*" required hidden>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="end-audio">Áudio final:</label>
                                    <div>
                                        <label id="label-end-audio" for="end-audio" class="btn btn-outline-primary">Carregar áudio final</label>
                                        <input type="file" name="end_audio" class="form-control-file" id="end-audio" onchange="validateEndAudio()" accept="audio/*" required hidden>
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
    let companyToList = ``
    let slides = ``

    $.getJSON('http://ramacciotti.org/tdc/api/slide.php?slide=0' + courseData, function (slideAPIData) {
        slideData = slideAPIData
    })
        .done(function () {

            slideData.forEach(function (allCoursesSlide) {
                if (allCoursesSlide.course == courseData.id) {
                    slides += `
                        <li class="list-group-item">
                            <h6 class="mb-4">${allCoursesSlide.title}</h6>
                            <form action="../controller/slideController.php" method="post">
                                <div class="row">
                                    <div class="form-group col-12 col-md-6 row">
                                        <label for="order" class="col-4">Posição</label>
                                        <input type="number" id="order" value="${allCoursesSlide.order}" name="slide_order" class="col-4 border rounded">
                                    </div>
                                    <div class="form-group col-12 col-md-6 text-md-right">
                                        <input type="hidden" value="${allCoursesSlide.id}" name="slide_id">
                                        <input type="hidden" value="${courseData.id}" name="course_id">
                                        <input type="submit" class="btn btn-sm btn-outline-success" value="Salvar" name="action">
                                        <input type="submit" class="btn btn-sm btn-outline-danger" value="Remover" name="action">
                                    </div>
                                </div>
                            </form>
                        </li>
                    `
                }
                addEditContent()
            })
        })

    $.getJSON('http://ramacciotti.org/tdc/api/company.php?company=0', function (companyAPIData) {
        companyData = companyAPIData
    })
        .done(function () {
            companyData.forEach(function (company) {
                if ($.isEmptyObject(courseData.company)) {
                    companyToList += `<option value="" disabled selected>Empresa...</option>`
                } else if (company.id == courseData.company) {
                    companyToList += `<option value="${company.id}" selected>${company.name}</option>`
                } else {
                    companyToList += `<option value="${company.id}">${company.name}</option>`
                }
            })
            addEditContent()
        })


    const addEditContent = function () {
        if (slides == undefined || companyToList == undefined) {
            return
        }
        let content = `
                    <h1 class="h3 text-white text-center p-1 mb-4">Editar Curso</h1>
                    <form action="../controller/editCourse.php" method="post" enctype="multipart/form-data">
                        <div class="container row mx-auto">
                            <div class="form-group col-12">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nome do curso" value="${courseData.name}" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="student-company">Empresa:</label>
                                <select class="custom-select" name="company" id="student-company" required>
                                    ${companyToList}
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <input type="hidden" value="${courseData.id}" name="course_id">
                                <button class="btn btn-sm btn-outline-secondary">Prova</button>
                                <input type="submit" name="action" class="btn btn-sm btn-outline-danger" value="Remover">
                                <input type="submit" name="action" class="btn btn-sm save text-white float-right" value="Salvar">
                            </div>
                        </div>
                    </form>
                    <form action="../controller/addSlide.php" method="post">
                        <h3 class="text-white text-center h4 py-1">Adicionar slide</h3>
                        <div class="container row mx-auto mt-4">
                            <div class="form-group col-9">
                                <label for="slide-name">Nome:</label>
                                <input type="text" id="slide-name" class="form-control" placeholder="Nome do slide" name="name">
                            </div>
                            <div class="form-group col-3">
                                <label for="slide-number">Posição:</label>
                                <input type="number" id="slide-number" class="form-control" name="position">
                            </div>
                            <div class="form-group col-6">
                                <div class="input-group">
                                    <label id="label-add-slide" for="add-slide" class="form-control btn btn-outline-primary">Carregar slide</label>
                                    <input type="file" name="slide" id="add-slide" onchange="validateSlide()" accept="image/*" required hidden>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <div class="input-group">
                                    <label id="label-add-audio" for="add-audio" class="form-control btn btn-outline-primary">Carregar áudio</label>
                                    <input type="file" name="audio" id="add-audio" onchange="validateAudio()" accept="audio/*" required hidden>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <input type="submit" name="action" class="btn btn-sm save text-white" value="Salvar">
                            </div>
                        </div>
                    </form>
                    <div class="mb-4">
                        <h3 class="text-white text-center h4 py-1">Editar slides</h3>
                        <div class="container mt-4">
                            <div class="container row mx-auto">
                                <ul class="container list-group list-group-flush list-group-striped">
                                    ${slides}
                                </ul>
                            </div>
                        </div>
                    </div>
                `

        $('#dynamic-content').html(content)
    }
}