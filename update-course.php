<?php
session_start();
include('config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:login.php');
} else {
    $studentregno =  $_SESSION['login'];
    $courseId= $_GET['id'];
    $status= $_GET['status'];
    if($status == 'E'){
        $ret=mysqli_query($con,"insert into courseenrolls(studentRegno,course) values('$studentregno','$courseId')");
        header('location:my-courses.php');
    }else if($status == 'C'){
        $ret=mysqli_query($con,"update courseenrolls set status='C', completedDate=now() where course='$courseId' and studentRegno=".$studentregno);
        header('location:courses-completed.php');
    }else if($status == 'F'){
        $ret=mysqli_query($con,"update courseenrolls set status='F', failedDate=now() where course='$courseId' and studentRegno=".$studentregno);
        header('location:courses-failed.php');
    }else if($status == 'R'){
        $ret=mysqli_query($con,"update courseenrolls set status='E', enrollDate=now() where course='$courseId' and studentRegno=".$studentregno);
        header('location:my-courses.php');            
    }else{
        header('location:courses.php');
    }
}
?>