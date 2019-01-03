
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
            <li><a href="../courses/index.php">Courses</a></li>
            <li class="active">Add New Course</a></li>
        </ul>

        <br>

        <div>
            <form name="newCourse" class="w3-container w3-card-4 w3-light-grey w3-padding-16 w3-margin-8"
                  method="post" action="actions.php?act=new">

                <h2>New Course</h2>
                <br>

                    <label>Course Title</label>
                    <input class="w3-input w3-border w3-round" name="courseTitle" type="text" required></p>

                <p>
                    <label>Year</label>
                    <input class="w3-input w3-border w3-round" name="year" type="number" min="2019" value="2019" required></p>

                <p>
                    <label>Semester</label>
                    <input class="w3-input w3-border w3-round" name="semester" type="number" min="1"  max="8" required></p>


                <p>
                    <label>Lecturer</label>
                    <select class="w3-select w3-border w3-round" name="lecId" required>
                        <option value="" disabled selected>Select the Lecturer</option>
                        <?php
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
                        <option value="" disabled selected>Select the Instructor</option>
                        <?php
                        $names=$db->listUsersByName();
                        foreach ($names as $name) {
                            echo "<option value=".$name['id'].">".$name['name']."</option>";
                        }
                        ?>
                    </select>
                </p>
                <div  >
                    <p>
                        <label>Contact Hours</label>
                        <input class="w3-input w3-border w3-round" name="contactHours" type="number" min="0" step="0.1"
                               required>
                    </p>

                    <p>
                        <label>Lab Hours</label>
                        <input class="w3-input w3-border w3-round" name="labHours" type="number" min="0" step="0.1"
                               >
                    </p>

                </div>
                <p>
                    <button id="save" type="submit" class="w3-btn w3-theme w3-round">Add Course</button>
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
