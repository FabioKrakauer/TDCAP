addCompanyView = function(){
    let content = 
        `
            <h1 class="h3 text-white text-center p-1 mb-4">Adicionar Empresa</h1>
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
                        <input type="submit" name="action" class="btn btn-sm save text-white" value="Salvar">
                    </div>
                </div>
            </form>
        `

    $('#dynamic-content').html(content)
}

showCompanyView = function (data) {
    var listCompanies = ``

    data.forEach(function (data) {
        listCompanies += 
        `
            <li class='list-group-item'>
                ${data.name}
                <button class='btn btn-outline-primary btn-sm btn-lg-lg float-right' onclick="editCompany(${data.id})">
                    Editar
                </button>
            </li>
        `
    })

    var content = `
        <h1 class='h3 text-white text-center p-1 mb-4'>Empresas Cadastradas</h1>
        <div class='container'><ul class='container list-group list-group-flush'>
            <ul>
                ${listCompanies}
            </ul>
        </div>
    `

    $('#dynamic-content').html(content)
}

editCompanyView = function(data) {
    var content = `
        <h1 class="h3 text-white text-center p-1 mb-4">Editar Empresa</h1>
        <form action="../controller/editCompany.php" method="post">
            <div class="container row mx-auto">
                <div class="form-group col-12">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" value="${data.name}">
                </div>
                <div class="form-group col-12">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" name="cnpj" id="cnpj" class="form-control" value="${data.cnpj}">
                </div>
                <div class="form-group col-12">
                    <label for="adress">Endereço:</label>
                    <input type="text" name="adress" id="adress" class="form-control" value="${data.adress}">
                </div>
                <div class="form-group col-12">
                    <label for="telephone">Telefone:</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" value="${data.phone}">
                </div>
                <div class="form-group col-12">
                    <label for="site">Site:</label>
                    <input type="text" name="site" id="site" class="form-control" value="${data.website}">
                </div>
                <div class="form-group col-12">
                    <label for="contact">Contato do responsável:</label>
                    <input type="text" name="contact" id="contact" class="form-control" value="${data.contact}">
                </div>
                <div class="form-group col-12">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control" value="${data.email}">
                </div>
                <div class="form-group col-12">
                    <input type="submit" name="action" class="btn btn-sm save text-white" value="Salvar">
                </div>
            </div>
        </form>
    `

    $('#dynamic-content').html(content)
}