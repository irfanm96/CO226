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
            <li><a href="../courses/index.php">Courses</a></li>
            <li class="active">Edit Course Details</a></li>
        </ul>

        <br>

        <div>
            <?php

            if (!isset($_GET['id'])) {
                echo "<h4>Invalid Access !!!</h4>";
                exit;

            } else if ($db->existsCourseId($_GET['id']) == 0) {
                echo "<h4>Invalid Course Id !!!</h4>";
                exit;
            }

            $id = $_GET['id'];


            $data=$db->getCourse($id);
            $courseId=$data['courseId'];
            $courseTitle=$data['courseTitle'];
            $year=$data['year'];
            $semester=$data['semester'];
            $lecId=$data['lecId'];
            $instId=$data['instId'];
            $contactHours=$data['contactHours'];
            $labHours=$data['labHours'];
            ?>
            <form name="editStudent" role="form" class="w3-container w3-card-4 w3-light-grey w3-padding-16 w3-margin-8"
                  method="post" action="actions.php?act=update">

                <h2>Edit Course Details</h2>
                <br>

                <p><input name="courseId" type="hidden" value="<?=$id; ?>"></p>

                <p>
                    <label>Course Title</label>
                    <input class="w3-input w3-border w3-round" name="courseTitle" type="text" required
                           value="<?=$courseTitle; ?>">

                </p>

                <p>
                    <label>Year</label>
                    <input class="w3-input w3-border w3-round" name="year" type="number" required
                           value="<?=$year; ?>"></p>

                <p>
                    <label>Semester</label>
                    <input class="w3-input w3-border w3-round" name="semester" type="number" min="1" max="8" required
                           value="<?= $semester;?>"></p>


                <p>
                    <label>Lecturer</label>
                    <select class="w3-select w3-border w3-round" name="lecId" required>
                        <?php
                        echo "<option value=".$lecId.">".$db->getUserName($lecId)."</option>";
                        $names=$db->listUsersByName();
                        foreach ($names as $name) {
                            echo "<option value=".$name['id'].">".$name['name']."</option>";
                        }
                        ?>
                    </select>
                <p>
                <p>
                    <label>Instructor</label>
                    <select class="w3-select w3-border w3-round" name="instId" >
                        <?php
                        echo "<option value=".$instId.">".$db->getUserName($instId)."</option>";
                        $names=$db->listUsersByName();
                        foreach ($names as $name) {
                            echo "<option value=".$name['id'].">".$name['name']."</option>";
                        }
                        echo "<option value=''>not assign</option>";
                        ?>
                    </select>
                </p>

                <div  >
                    <p>
                        <label>Contact Hours</label>
                        <input class="w3-input w3-border w3-round" name="contactHours" type="number" min="0" step="0.1"
                               value="<?=$contactHours?>" required>
                    </p>

                    <p>
                        <label>Lab Hours</label>
                        <input class="w3-input w3-border w3-round" name="labHours" type="number" min="0" step="0.1"
                               value="<?=$labHours?>" >
                    </p>

                </div>

                <p>
                    <button type="submit" class="w3-btn w3-theme w3-round">Update Course Details</button>
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