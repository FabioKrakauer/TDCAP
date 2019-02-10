createCompanyView = function (data) {
    var listCompanies = ``

    data.forEach(function (data) {
        listCompanies += `
                            <li class='list-group-item'>
                                ${data.name}
                                <button class='btn btn-outline-primary btn-sm btn-lg-lg float-right' onclick="editCompany(${data.id})">
                                    Editar
                                </button>
                            </li>`
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

editCompanyView = function(data) {
    var content = `
        <h1 class="h3 text-white text-center p-1 mb-4">Editar Empresa</h1>
        <form action="../controller/editCompany.php" method="post">
            <div class="container row mx-auto">
                <div class="form-group col-12">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="${data.name}">
                </div>
                <div class="form-group col-12">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="${data.cnpj}">
                </div>
                <div class="form-group col-12">
                    <label for="adress">Endereço:</label>
                    <input type="text" name="adress" id="adress" class="form-control" placeholder="${data.adress}">
                </div>
                <div class="form-group col-12">
                    <label for="telephone">Telefone:</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" placeholder="${data.phone}">
                </div>
                <div class="form-group col-12">
                    <label for="site">Site:</label>
                    <input type="text" name="site" id="site" class="form-control" placeholder="${data.website}">
                </div>
                <div class="form-group col-12">
                    <label for="contact">Contato do responsável:</label>
                    <input type="text" name="contact" id="contact" class="form-control" placeholder="${data.contact}">
                </div>
                <div class="form-group col-12">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="${data.email}">
                </div>
                <div class="form-group col-12">
                    <input type="submit" name="action" class="btn btn-sm save text-white" value="Salvar">
                </div>
            </div>
        </form>
    `

    $('#dynamic-content').html(content)
}