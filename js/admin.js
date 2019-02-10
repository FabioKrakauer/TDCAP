$(document).ready(function(){

    addCompany = function (event){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(1)').addClass('active-content')
    }
    
    showCompany = function (event){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(2)').addClass('active-content')
        $.getJSON('http://ramacciotti.org/tdc/api/company.php?company=0', function (data) {
            createCompanyView(event, data)
        })
    }

    addStudent = function (event){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(3)').addClass('active-content')
    }
    
    showStudent = function (event){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(4)').addClass('active-content')
        $.getJSON('http://ramacciotti.org/tdc/api/student.php?student=0', function (data) {
            console.log(data)
        })
    }

    addCourse = function (event){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(5)').addClass('active-content')
    }

    showCourse = function (event){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(6)').addClass('active-content')
        $.getJSON('http://ramacciotti.org/tdc/api/course.php?course=0', function (data) {
            console.log(data)
        })
    }
})
