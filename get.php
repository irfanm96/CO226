<!DOCTYPE html>
<html>
<head>
    <title>My page</title>
</head>
<style type="text/css">

    .box1 {
        width: 600px;
        height: 20px;
        margin-left: 100px;
        text-align: center;
    }

    .details {
        position: absolute;
        left: 618px;
        top: 352px;
    }


</style>
<body>
<div style="margin-left: 280px;border-style: solid;width: 800px;height: 500px">
    <h1 style="text-align: center">Your Information System</h1>
    <div style ="margin-left: 5%">
   		<?php 
		
		$firstname=$_GET["firstname"];
		$lastname=$_GET["lastname"];
		$address1=$_GET["address1"];
		$address2=$_GET["address2"];
		$address3=$_GET["address3"];
		$wristband=$_GET["wristband"];		
		$cap=$_GET["cap"];
		$size =$_GET["size"];
		$color=$_GET["color"];
        $comments=$_GET["comments"];
		
        
    echo "<p>Thank You,  $firstname for your perches from our website </p>";
    echo "<p>Your item color is : $color   & T-shirt size : $size <p>";
    echo "<p>Selected items/item are : <p>";
      if($wristband!==null){
		echo "<p>*$wristband</p>";
		}  
	 if($cap!==null){
		echo "*$cap";
		}	 
   echo "<p>Your items will be sent to:</p>
     $firstname  $lastname,<br>
		  $address1,<br> 
		  $address2,<br>	
		  $address3<br>
		
   <p>Thank you for submitting your comments.We appritiate it.You said:</p>
    $comments"; 
    ?>
    </div>
</div>
</body>
</html>
