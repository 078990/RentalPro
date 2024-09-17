<?php 	
$con=mysqli_connect("localhost","root","","company");
$Names=$_POST['cname'];
$Phone=$_POST['phone'];
$email=$_POST['email'];

$insert=mysqli_query($con,"INSERT into clients values ('','$Names','$Phone','$email')");
if ($insert==true){
	//code...
	echo'<strong>DONE!! </strong><p> Your data sent successfully .</p>';
	
}
else{
	echo "0";
}

 ?> 