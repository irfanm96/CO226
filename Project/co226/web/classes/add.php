
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

?>

<div class="w3-row">
    <div class="w3-col m2 l2 hidden-sm">&nbsp;</div>
    <div class="w3-col s12 m8 l8">
        <br><br><br><br>

        <ul class="breadcrumb w3-card-2 w3-container w3-margin-8">
            <li><a href="../home">Home</a></li>
            <li><a href="../classes/index.php">Classes</a></li>
            <li class="active">Add New Class</a></li>
        </ul>

        <br>

        <div>
            <form name="newClass" class="w3-container w3-card-4 w3-light-grey w3-padding-16 w3-margin-8"
                  method="post" action="actions.php?act=new">

                <h2>New Class</h2>
                <br>

                    <label>Class Date</label>
                    <input class="w3-input w3-border w3-round" name="classDate" type="date" required></p>

                <p>
                    <label>Class Time</label>
                    <input class="w3-input w3-border w3-round" name="classTime" type="time" min="0" required></p>

                <p>
                    <label>Duration</label>
                    <input class="w3-input w3-border w3-round" name="duration" type="number" min="0" step="0.1" required></p>


                <p>
                    <label>Course</label>
                    <select class="w3-select w3-border w3-round" name="courseId" required>
                        <option value="" disabled selected>Select the Course</option>
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
                        <option value=""disabled selected>Select the Class Type</option>
                        <option value="lab">Lab</option>
                        <option value="lecture" >Lecture</option>
                        <option value="tutorial" >Tutorial</option>
                    </select>
                </p>
                <p>
                    <label>Lecturer</label>
                    <select class="w3-select w3-border w3-round" name="conductedBy" required>
                        <option value="" disabled selected>Select the Lecturer</option>
                        <?php
                        $names=$db->listUsersByName();
                        foreach ($names as $name) {
                            echo "<option value=".$name['id'].">".$name['name']."</option>";
                        }
                        ?>
                    </select>
                </p>

                <p>
                    <button id="save" type="submit" class="w3-btn w3-theme w3-round">Add Class</button>
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
