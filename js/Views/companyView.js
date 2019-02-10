createCompanyView = function (event, data) {

    var listCompanies = ``

    data.forEach(function (data) {
        listCompanies += `<li class='list-group-item'>${data.name}<button class='btn btn-outline-primary btn-sm btn-lg-lg float-right'>Editar</button></li>`
    })

    var empresasCadastradas = `
        <h1 class='h3 text-white text-center p-1 mb-4'>Empresas Cadastradas</h1>
        <div class='container'><ul class='container list-group list-group-flush'>
            <ul>
                ${listCompanies}
            </ul>
        </div>
    `

    $('#dynamic-content').html(empresasCadastradas)
}