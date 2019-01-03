<?php include '../data/session.php'; ?>

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

if (!($_SESSION['role'] == 0 || $_SESSION['role'] == 4)) {
    include_once '../404.shtml';
    exit;
}

?>

<div class="w3-row">
    <div class="w3-col m2 l2 hidden-sm">&nbsp;</div>
    <div class="w3-col s12 m8 l8">
        <br><br><br><br>

        <ul class="breadcrumb w3-card-2 w3-container w3-margin-8">
            <li><a href="../home">Home</a></li>
            <li><a href="../users">Users</a></li>
            <li class="active">Delete Users</a></li>
        </ul>

        <br>

        <div>
            <?php

            if (!isset($_GET['id'])) {
                echo "<h4>Invalid Access !!!</h4>";
                exit;

            } else if ($db->existsUserId($_GET['id']) == false) {
                echo "<h4>Invalid user Id !!!</h4>";
                exit;
            }

            $id = $_GET['id'];

            $firstName = $db->getUserData($id, "firstName");
            $lastName = $db->getUserData($id, "lastName");
            $email = $db->getUserData($id, "email");
            $role = $db->getUserData($id, "role");

            ?>
            <form name="newStudent" role="form" class="w3-container w3-card-4 w3-light-grey w3-padding-16 w3-margin-8"
                  method="post" action="actions.php?act=delete">

                <h2>Delete User</h2>
                <br>

                <input name="userId" type="hidden" value="<?php echo $id; ?>"></p>

                <p>

                <p>Are you sure to delete <?php echo "$firstName $lastName ($email)"; ?> ? <br></p>

                <p>
                    <button type="submit" class="w3-btn w3-theme w3-round">&nbsp;&nbsp;Yes&nbsp;&nbsp;</button>
                </p>

            </form>
        </div>

        <br><br><br><br>

    </div>

</div>

</body>
</html>