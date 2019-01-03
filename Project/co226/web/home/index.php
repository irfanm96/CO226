
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../data/meta.php'; ?>
    <?php include '../data/scripts.php'; ?>

    <link href="../css/home.css" rel="stylesheet"/>
</head>
<body>

<?php include '../data/navibar.php'; ?>

<?php
include "../data/database.php";
$db = new database();
?>

<div class="w3-container">
    <div class="w3-row">
        <div class="w3-col m2 l2 hidden-sm">&nbsp;</div>
        <div class="w3-col s12 m8 l8">
            <div class="w3-container">
                <?php


                print "<div class='w3-row' style='padding-top: 20px;'><h3 class='home-group'>&nbsp;</h3></div>";
                print " <div class='w3-row'>";

                //if ($_SESSION['role'] == 0 || $_SESSION['role'] == 4) {
                    // Admin || Data Enter
                    printTile("Users", "../users/index.php", "contact.png", "w3-metro-purple");
                    printTile("Add New User", "../users/add.php", "new.png", "w3-metro-dark-orange");
                //}


                print "</div>";
                ?>
            </div>
        </div>
    </div>
    <br><br><br>
</div>

<script>
    function navigate(url) {
        window.location.href = url;
    }
</script>


<?php
//include_once '../data/footer.php';

if (isset($_GET['welcome'])) {
    $db->set_userData($userId, "status", "ACTIVE");
    include_once 'welcome.html';
}

function newRow($c)
{
    if ($c == 4) {
        $c = 0;
        print "</div><br><br><div class='row'>";
    }
    return $c;
}


function printTile($title, $href, $img, $color)
{
    print "
        <div class='w3-col s6 m4 l3' style='padding: 4px!important;'>
            <a href='$href' class='w3-center' style='text-decoration: none;'>
            <div class='$color w3-center homeTile'>
                <img class='w3-animate-opacity' style='width: 60%;' src='../img/iconsHome/$img'>
                <div class='w3-responsive homeTileName'>$title</div>
            </div>
            </a>
        </div>";
}

?>

</body>
</html>
