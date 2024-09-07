<?php 
include_once '../Database/Connect.php';
if(isset($_POST['SaveUsers'])){
    $FirstName=$_POST['SaveUsers'];
    $LastName=$_POST['PLastName'];
    $Password=$_POST['PPassword'];
    $ConfPass=$_POST['PconfirmPassword'];
    $Email=$_POST['Pemail'];
    $Usertype=$_POST['PUserType'];
    $FullName=$FirstName.' '.$LastName;
    
    $Msg=[];
       
        if(!preg_match("/[a-zA-Z]/", $FirstName) || !preg_match("/[a-zA-Z]/", $LastName)){
            $Msg[]="First and Last name should be in letter only!";
            echo json_encode($Msg);
        }
        elseif(empty($FirstName)|| empty($LastName) || empty($Password)|| empty($ConfPass)|| empty($Email)|| empty($Usertype)){
            $Msg[]="All fields required";
            echo json_encode($Msg);
        }
        elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $Msg[]="Invalid Email!";
            echo json_encode($Msg);
        }
        elseif(strlen($Password)<=6){
            $Msg[]="Password should be more than 6 characters";
            echo json_encode($Msg);
        }
        elseif($Password!=$ConfPass){
            $Msg[]="Password are not marching !";
            echo json_encode($Msg);
        }
        else{
            $res=mysqli_query($conn, "INSERT INTO users(First_Name, Last_Name, Full_Name, Email, Password, Job_Title) VALUES ('$FirstName','$LastName','$FullName','$Email','$Password','$Usertype')");
            $Msg[]="Success";
            echo json_encode($Msg);
        }
}

// Update the users -------------------------------------->
if(isset($_POST['UpdateUsers'])){
    $FirstName=$_POST['UpdateUsers'];
    $LastName=$_POST['PLastName'];
    $Password=$_POST['PPassword'];
    $ConfPass=$_POST['PconfirmPassword'];
    $Email=$_POST['Pemail'];
    $Usertype=$_POST['PUserType'];
    $IDRecord=$_POST['PIDRecord'];
    $Msg=[];
        if(empty($FirstName)|| empty($LastName) || empty($Password)|| empty($ConfPass)|| empty($Email)|| empty($Usertype)){
            $Msg[]="All fields required";
            echo json_encode($Msg);
        }
        elseif(!preg_match("/[a-zA-Z]/", $FirstName) || !preg_match("/[a-zA-Z]/", $LastName)){
            $Msg[]="First and Last name should be in letter only!";
            echo json_encode($Msg);
        }
        elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $Msg[]="Invalid Email!";
            echo json_encode($Msg);
        }
        elseif(strlen($Password)<=6){
            $Msg[]="Password should be more than 6 characters";
            echo json_encode($Msg);
        }
        elseif($Password!=$ConfPass){
            $Msg[]="Password are not marching !";
            echo json_encode($Msg);
        }
        else{
            $FullName=$FirstName.' '.$LastName;
            $res=mysqli_query($conn, "UPDATE users SET First_Name='$FirstName',Last_Name='$LastName',Full_Name='$FullName',Email='$Email',Password='$Password',Job_Title='$Usertype' WHERE Id='$IDRecord'");
            $Msg[]="Success";
            echo json_encode($Msg);
        }
}

// Delete users------------------------------------------->
if(isset($_POST['DeleteUser'])){
    $IDRecord=$_POST['DeleteUser'];
    $res=mysqli_query($conn, "DELETE FROM users WHERE Id='$IDRecord'");
}

// Get data----------------------------------------------->

if(isset($_POST['UserData'])){
    $Role=$_POST['UserData'];
    $UserID=$_POST['UserID'];
    $Msg=[];

    if($Role=="Manager"){
        $res=mysqli_query($conn, "SELECT * FROM users");
        while($rows=mysqli_fetch_assoc($res)){
            $Msg[]=$rows;
        }
        echo json_encode($Msg);

    }else{
        $res=mysqli_query($conn, "SELECT * FROM users WHERE Id='$UserID'");
        while($rows=mysqli_fetch_assoc($res)){
            $Msg[]=$rows;
        }
        echo json_encode($Msg);
    }
}

// Update the patsient user
if(isset($_POST['UpdatePatient'])){
    $FirstName=$_POST['UpdatePatient'];
    $LastName=$_POST['PLastName'];
    $Password=$_POST['PPassword'];
    $ConfPass=$_POST['PconfirmPassword'];
    $Email=$_POST['Pemail'];
    $IDRecord=$_POST['PIDRecord'];
    $Msg=[];

        if(!preg_match("/[a-zA-Z]/", $FirstName) || !preg_match("/[a-zA-Z]/", $LastName)){
            $Msg[]="First and Last name should be in letter only!";
            echo json_encode($Msg);
        }
        elseif(empty($FirstName)|| empty($LastName) || empty($Password)|| empty($ConfPass)|| empty($Email)){
            $Msg[]="All fields required";
            echo json_encode($Msg);
        }
        
        elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $Msg[]="Invalid Email!";
            echo json_encode($Msg);
        }
        elseif(strlen($Password)<=6){
            $Msg[]="Password should be more than 6 characters";
            echo json_encode($Msg);
        }
        elseif($Password!=$ConfPass){
            $Msg[]="Password are not marching !";
            echo json_encode($Msg);
        }
        else{
            $FullName=$FirstName.' '.$LastName;
            $res=mysqli_query($conn, "UPDATE users SET First_Name='$FirstName',Last_Name='$LastName',Full_Name='$FullName',Email='$Email',Password='$Password',Job_Title='Patient' WHERE Id='$IDRecord'");
            $Msg[]="Success";
            echo json_encode($Msg);
        }
}
?>