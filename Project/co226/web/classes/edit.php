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

?>

<div class="w3-row">
    <div class="w3-col m2 l2 hidden-sm">&nbsp;</div>
    <div class="w3-col s12 m8 l8">
        <br><br><br><br>

        <ul class="breadcrumb w3-card-2 w3-container w3-margin-8">
            <li><a href="../home">Home</a></li>
            <li><a href="../classes/index.php">Classes</a></li>
            <li class="active">Edit Class Details</a></li>
        </ul>

        <br>

        <div>
            <?php

            if (!isset($_GET['id'])) {
                echo "<h4>Invalid Access !!!</h4>";
                exit;

            }
            $id = $_GET['id'];
            $data = $db->getClass($id);
//            var_dump($data);
            $courseId = $data['courseId'];
            $classType = $data['classType'];
            $classDate = $data['classDate'];
            $classTime = $data['classTime'];
            $duration = $data['duration'];
            $conductedBy = $data['conductedBy'];

            $course = $db->getCourse($courseId);
            $lec=$db->getUserName($conductedBy);
            $courses = $db->listCourses();
            $names = $db->listUsersByName();
            ?>
            <form name="editClass" role="form" class="w3-container w3-card-4 w3-light-grey w3-padding-16 w3-margin-8"
                  method="post" action="actions.php?act=update">

                <h2>Edit Class Details</h2>
                <br>

                <p><input name="id" type="hidden" value="<?=$id;?>"></p>


                <label>Class Date</label>
                <input class="w3-input w3-border w3-round" name="classDate" type="date" value="<?= $classDate?>" required></p>

                <p>
                    <label>Class Time</label>
                    <input class="w3-input w3-border w3-round" name="classTime" type="time" min="0" value="<?= $classTime?>" required></p>

                <p>
                    <label>Duration</label>
                    <input class="w3-input w3-border w3-round" name="duration" type="number" min="0" step="0.1" value="<?= $duration?>" required></p>


                <p>
                    <label>Course</label>
                    <select class="w3-select w3-border w3-round" name="courseId" required>
                        <option value="<?= $course['courseId']?>" selected><?= $course['courseTitle']?></option>
                        <?php
                        $courses=$db->listCourses();
                        foreach ($courses as $course) {
                            echo "<option value=".$course['courseId'].">".$course['courseTitle']."</option>";
                        }
                        ?>
                    </select>
                </p><p>
                    <label>Class Type</label>
                    <select class="w3-select w3-border w3-round" name="classType">
                        <option value="<?= $classType?>" selected><?=$classType?></option>
                        <option value="lab">Lab</option>
                        <option value="lecture" >Lecture</option>
                        <option value="tutorial" >Tutorial</option>
                    </select>
                </p>
                <p>
                    <label>Lecturer</label>
                    <select class="w3-select w3-border w3-round" name="conductedBy" required>
                        <option value="<?= $conductedBy?>" selected><?=$lec?></option>
                        <?php
                        $names=$db->listUsersByName();
                        foreach ($names as $name) {
                            echo "<option value=".$name['id'].">".$name['name']."</option>";
                        }
                        ?>
                    </select>
                </p>


                <p>
                    <button type="submit" class="w3-btn w3-theme w3-round">Update Class Details</button>
                </p>

            </form>
        </div>

        <br><br><br><br>

    </div>

</div>


<script>

</script>

</body>
</html>