<?php //include '../data/session.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../data/meta.php'; ?>
    <?php include '../data/scripts.php'; ?>

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

$userRoles = array(0 => "Admin", 1 => "Student", 2 => "Lecturer", 3 => "Instructor", 4 => "Date Enter");

?>

<div class="w3-container">
    <div class="w3-row">
        <div class="w3-col m2 l2 hidden-sm">&nbsp;</div>
        <div class="w3-col s12 m8 l8">
            <br><br><br><br>

            <ul class="breadcrumb w3-card-2 w3-container w3-margin-8">
                <li><a href="../home">Home</a></li>
                <li class="active">Courses</a></li>
            </ul>

            <ul class="w3-navbar w3-theme-l2" style="margin: 10px 16px;">
                <li><a href="#" class="tablink w3-theme">View</a></li>
                <li><a href="add.php" class="tablink">New Course </a></li>
                <li><a href="#" class="tablink">Other</a></li>
            </ul>

            <br>

            <div class="w3-container">
                <div class="w3-responsive">
                    <table class="w3-table w3-bordered w3-striped w3-border w3-hoverable">
                        <tr>
                            <th>Course ID</th>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Lecturer</th>
                            <th>Instructor</th>
                            <th>Contact Hours</th>
                            <th>Lab Hours</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        $details = $db->listCourses();
                        foreach ($details as $detail) {
                            print "<tr>
                        <td>".$detail['courseId']."</td>
                        <td>".$detail['courseTitle']."</td>
                        <td>".$detail['year']."</td>
                        <td>".$detail['semester']."</td>
                        <td>".$db->getUserName($detail['lecId'])."</td>
                        <td>".$db->getUserName($detail['instId'])."</td>
                        <td>".$detail['contactHours']."</td>
                        <td>".$detail['labHours']."</td>
                        <td>"."
                        <a href=edit.php?id=".$detail['courseId'].">Edit</a> | <a href=delete.php?id=".$detail['courseId'].">Delete</a></td></tr>";
                        }
                        ?>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <br><br><br>
</div>

</body>
</html>