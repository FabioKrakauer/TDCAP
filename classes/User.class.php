<?php

$dir = realpath(__DIR__ . '/..');
require_once $dir.'/config.inc.php';
require_once 'Course.class.php';
require_once 'Company.class.php';
require_once 'Question.class.php';
require_once 'Auth.class.php';

class User{

    private $id;
    private $name;
    private $email;
    private $password;
    private $company;
    private $courses;
    private $activeCourses;
    private $admin;
    private $first_access;

    function __construct($id){
        global $database;

        $fields = $database->getFieldValue("SELECT * FROM `user` WHERE `id`='$id'");
        $this->id = $fields["id"];
        $this->name = $fields["name"];
        $this->email = $fields["email"];
        $this->password = $fields["password"];
        $this->company = new Company($fields["company"]);
        $this->admin = $fields["admin"];
        $this->first_access = $fields["created_at"];
        $this->courses = [];
        $coursesFields = $database->getFieldsValues("SELECT `course_id` FROM `user_course` WHERE `user_id`='$id'");
        foreach($coursesFields as $position=>$course){
            if($course["course_id"] != 0){
                array_push($this->courses, new Course($course["course_id"]));
            }
        }
        $this->activeCourses = array();
        $activeCourses = $database->getFieldsValues("SELECT `course_id` FROM `user_course` WHERE `user_id`='$id' AND `disabled`='0'");
        foreach($activeCourses as $position=>$course){
            if($course["course_id"] != 0){
                array_push($this->activeCourses, new Course($course["course_id"]));
            }
        }
    }
    function getID(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getActiveCourses(){
        return $this->activeCourses;
    }
    function getEmail(){
        return $this->email;
    }
    function getCompany(){
        return $this->company;
    }
    function isAdmin(){
        global $database;
        $id = $this->getID();
        $result = $database->getFieldValue("SELECT `admin` FROM `user` WHERE `id`='$id'");
        if($result != null){
            if($result["admin"] == 1){
                return true;
            }
        }
        return false;
    }
    function getFirstAccess(){
        
        return $this->first_access;
    }
    function getCourses(){
        return $this->courses;
    }
    function getCourse(){
        return $this->courses;
    }
    function viewSlide($slideID){
        global $database;
        $user = Auth::user()->getID();
        $fields = $database->getFieldValue("SELECT * FROM `user_slides` WHERE `user_id`='$user' AND `slide_id` = '$slideID'");
        if($fields == null){
            return false;
        }else{
            return true;
        }
    }
    function addSlideView($slide){
        global $database;
        $userID = Auth::user()->getID();
        if($this->viewSlide($slide->getID())){
            return false;
        }else{
            $database->query("INSERT INTO `user_slides` (`id`, `user_id`, `course_id`, `slide_id`) VALUES (NULL, '$userID', '".$slide->getCourse()->getID()."' ,'".$slide->getID()."')");
        }
    }
    function getCourseProgress($courseID){
        global $database;
        $userID = $this->id;
        $slidesCourse = $database->getFieldValue("SELECT COUNT(`title`) AS `value` FROM `slides` WHERE `course_id`='$courseID'");
        $slidesQuantity = $slidesCourse["value"];
        $slidesViews = $database->getFieldValue("SELECT COUNT(`slide_id`) AS `value` FROM `user_slides` WHERE `course_id`='$courseID' AND `user_id`='$userID'");
        $views = $slidesViews["value"];
        $views *= 100;
        if($slidesQuantity == 0){
            return 0;
        }
        $porcent = $views / $slidesQuantity;
        if($porcent > 100){
            return 100;
        }
        $progress = $views / $slidesQuantity;
        return (int) $progress;
    }
    function getUserMakeExam($courseID){
        global $database;
        $user = Auth::user();
        $userID = $user->getID();
        $field = $database->getFieldValue("SELECT `id` FROM `user_exam_result` WHERE `user_id`='$userID' AND `course_id`='$courseID'");
        if($field == null){
            return false;
        }
        return true;
    }
    function getUserExamResult($courseID){
        global $database;
        $user = Auth::user();
        $userID = $user->getID();
        $field = $database->getFieldValue("SELECT `result` FROM `user_exam_result` WHERE `user_id`='$userID' AND `course_id`='$courseID'");
        return $field["result"];
    }
}