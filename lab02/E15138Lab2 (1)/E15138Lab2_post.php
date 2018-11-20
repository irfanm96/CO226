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
		
		$firstname=$_POST["firstname"];
		$lastname=$_POST["lastname"];
		$address1=$_POST["address1"];
		$address2=$_POST["address2"];
		$address3=$_POST["address3"];
		$wristband=$_POST["wristband"];		
		$cap=$_POST["cap"];
		$size =$_POST["size"];
		$color=$_POST["color"];
        $comments=$_POST["comments"];
		
        
    echo "<p>Thank You,  $firstname for your perches from our website </p>";
    echo "<p>Your item color is : $color   & T-shirt size : $size <p>";
    echo "<p>Selected items/item are : <p>";
	
        if($wristband!=null){
	echo "<p>*$wristband</p>";
	}	
	if($cap!=null){
	echo "*$cap<br>";
	}
		
		 
   echo "<p>Your items will be sent to:</p>";
     echo "$firstname  $lastname,<br>";
		  if($address1!=null){
			echo "$address1,<br>";			
			}
		  if($address2!=null){
			echo "$address2,<br>";			
			}
		
		  if($address3!=null){
			echo "$address3<br>";			
			}

   echo "<p>Thank you for submitting your comments.We appritiate it.You said:</p>
    $comments"; 
    ?>
    </div>
</div>
</body>
</html>
