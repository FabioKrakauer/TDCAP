$(document).ready(function(){

    addCompany = function (){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(1)').addClass('active-content')
        addCompanyView()
    }
    
    showCompany = function (){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(2)').addClass('active-content')
        $.getJSON('http://ramacciotti.org/tdc/api/company.php?company=0', function (data) {
            showCompanyView(data)
        })
    }

    editCompany = function(id){
        $.getJSON('http://ramacciotti.org/tdc/api/company.php?company=' + id, function (data) {
            editCompanyView(data)
        })
    }
    
    addStudent = function (){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(3)').addClass('active-content')
        addStudentView()
    }
    
    showStudent = function (){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(4)').addClass('active-content')
        $.getJSON('http://ramacciotti.org/tdc/api/student.php?student=0', function (data) {
            showStudentView(data)
        })
    }

    editStudent = function(){
        $.getJSON('http://ramacciotti.org/tdc/api/student.php?student=' + id, function (data) {
            editStudentView(data)
        })
    }
    
    addCourse = function (){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(5)').addClass('active-content')
        addCourseView()
    }
    
    showCourse = function (){
        $('#admin-list li').removeClass('active-content')
        $('#admin-list li:nth-child(6)').addClass('active-content')
        $.getJSON('http://ramacciotti.org/tdc/api/course.php?course=0', function (data) {
            showCourseView(data)
        })
    }

    editCourse = function(){
        $.getJSON('http://ramacciotti.org/tdc/api/course.php?course=' + id, function (data) {
            editCourseView(data)
        })
    }
})
