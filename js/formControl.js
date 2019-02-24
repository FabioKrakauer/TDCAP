validateCNPJ = function () {
    $('#cnpj').mask('00.000.000/0000-00', { reverse: true });
}

validatePhone = function () {
    $('#telephone').mask('(00) 0000-00009')
    $('#telephone').keyup(function () {
        if ($('#telephone').val().length == 15) {
            $('#telephone').mask('(00) 00000-0000')
        } else {
            $('#telephone').mask('(00) 0000-00009');
        }
    });
}

validatePassword = function(){
    let pass = $('#password')
    let passConf = $('#password-conf')
    if(pass != passConf){
        alert('As senhas não conferem. Tente novamente.')
        return false
    }
}