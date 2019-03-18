menuShow = function(){
    $('#slides-list').show()
    $('#slides-list').css('width', '280px')
    $('#slides-list').css('margin-top', '16px')
    $('#slides-list').css('position', 'absolute')
    $('.show').hide()
    $('.hide').show()    
}

menuHide = function(){
    $('#slides-list').hide()
    $('#slides-list').css('width', '0')
    $('#slides-list').css('margin-top', '0')
    $('#slides-list').css('position', 'unset')
    $('.show').show()
    $('.hide').hide() 
}