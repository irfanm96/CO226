<?php

//include_once '../data/session.php';
include_once '../data/database.php';

$db = new database();

//$userId = $_SESSION['userId'];
//$userName = $_SESSION['user'];

$action = 0;

$act = $_GET['act'];

//if (!($_SESSION['role'] == 0 || $_SESSION['role'] == 4)) {
//    include_once '../404.shtml';
//    exit;
//}


if ($act == "new") {
    $courseTitle = $_POST['courseTitle'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $lecId= $_POST['lecId'];
    $instId= $_POST['instId'];
    $contactHours= $_POST['contactHours'];
    $labHours= $_POST['labHours'];

    if ($db->existsCourseTitle($courseTitle,$year)) {
        echo "<script>alert('Sorry, Course has been already created!');</script>";
        echo "<script>history.go(-1);</script>";

    } else  {

        $d=$db->newCourse($courseTitle, $year, $semester, $lecId, $instId, $contactHours, $labHours);
        echo "<script>alert('Course Created Successfully');</script>";
        echo "<script>window.location.href='index.php'</script>";

    }
} else if ($act == "update") {

    $courseId = $_POST['courseId'];
    $result=$db->setCourseData($courseId,$_POST);
    if(!$result){
        echo "<script>alert('Sorry, an unknown error occurred !);</script>";
        echo "<script>history.go(-1);</script>";

    }else{
        echo "<script>alert('Course Details Has Been Updated');</script>";
        echo  "<script>window.location.href='./index.php';</script>";
    };

}







