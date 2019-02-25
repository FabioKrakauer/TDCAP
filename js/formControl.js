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
    let pass = $('#password')[0].value
    let passConf = $('#password-conf')[0].value
    if(pass != passConf){
        alert('As senhas não conferem. Tente novamente.')
        return false
    }
}

validateInicialSlide = function(){
    if($("#inicial-slide")[0].files[0].name != ""){
        $("#label-inicial-slide").html('Arquivo adicionado!')
        $("#label-inicial-slide").removeClass('btn-outline-primary')
        $("#label-inicial-slide").addClass('btn-success')
    }
}

validateEndSlide = function(){
    if($("#end-slide")[0].files[0].name != ""){
        $("#label-end-slide").html('Arquivo adicionado!')
        $("#label-end-slide").removeClass('btn-outline-primary')
        $("#label-end-slide").addClass('btn-success')
    }
}

validateInicialAudio = function(){
    if($("#inicial-audio")[0].files[0].name != ""){
        $("#label-inicial-audio").html('Arquivo adicionado!')
        $("#label-inicial-audio").removeClass('btn-outline-primary')
        $("#label-inicial-audio").addClass('btn-success')
    }
}

validateEndAudio = function(){
    if($("#end-audio")[0].files[0].name != ""){
        $("#label-end-audio").html('Arquivo adicionado!')
        $("#label-end-audio").removeClass('btn-outline-primary')
        $("#label-end-audio").addClass('btn-success')
    }
}