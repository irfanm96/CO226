<?php //include '../data/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../data/meta.php'; ?>
    <?php include '../data/scripts.php'; ?>

    <style>
        label {
            margin: 5px !important;
        }
    </style>
</head>
<body>

<a name="top"></a>
<?php include '../data/navibar.php'; ?>

<?php
include "../data/database.php";
$db = new database();

//if (!($_SESSION['role'] == 0 || $_SESSION['role'] == 4)) {
//    include_once '../404.shtml';
//    exit;
//}
//
//?>
<?php

            if (!isset($_GET['id'])) {
                echo "<h4>Invalid Access !!!</h4>";
                exit;

            } else if ($db->existsCourseId($_GET['id']) == 0) {
                echo "<h4>Invalid Course Id !!!</h4>";
                exit;
            }
            $id = $_GET['id'];
            echo "<script>alert('Are You Sure')</script>";
            if($db->deleteCourseData($id)){
                echo "<h2>Course Deleted</h2>";
                echo "<script>window.location.href='index.php'</script>";
            }
            ?>
