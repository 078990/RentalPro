<?php 	
$con=mysqli_connect("localhost","root","","company");
$Names=$_POST['Names'];
$Phone=$_POST['Phone'];
$email=$_POST['email'];

$insert=mysqli_query($con,"INSERT into clients values ('','$Names','$Phone','$email')");
if ($insert==true){
	//code...
	echo'<strong>DONE!! </strong><p> Your password has been successfully updated.</p>';
	
}
else{
	echo "0";
}

 ?> 