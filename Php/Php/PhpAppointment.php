<?php 
include_once '../Database/Connect.php';
 //require 'vendor/autoload.php';
 require __DIR__ . '/vendor/autoload.php';
 use AfricasTalking\SDK\AfricasTalking;

if(isset($_POST['SaveAvailability'])){
    $FirstDate=$_POST['SaveAvailability'];
    $EndDate=$_POST['PEndDate'];
    $UserID=$_POST['PUserID'];
    $Today=new DateTime();
    $Ysterday=$Today->modify("-1 days")->format('Y-m-d');
    $substrDate=substr($FirstDate,0,10);
    $Msg=[];
        if(empty($FirstDate)|| empty($EndDate)){
            $Msg[]="All fields required";
            echo json_encode($Msg);
        }
        elseif($substrDate==$Ysterday){
            $Msg[]="You can't scheduled yesterday";
            echo json_encode($Msg);
        }
        elseif($FirstDate>=$EndDate){
            $Msg[]="Kindly Check The First and End Date Again";
            echo json_encode($Msg);
        }
        
        else{
            $res=mysqli_query($conn, "INSERT INTO appointment(FromDate, EndDate, UserID) VALUES ('$FirstDate','$EndDate','$UserID')");
            $Msg[]="Success";
            echo json_encode($Msg);
        }



}
if(isset($_POST['SaveRescheduled'])){
    $Reason=$_POST['SaveRescheduled'];
    $PChosenDate=$_POST['PChosenDate'];
    $PIDRecords=$_POST['PIDRecords'];
    $PUserID=$_POST['PUserID'];
    $dateToday=date("Y-m-d");
    $Today=new DateTime();
    $Ysterday=$Today->modify("-1 days")->format('Y-m-d');
    $substrDate=substr($PChosenDate,0,10);
    $Msg=[];
        if(empty($Reason)|| empty($PChosenDate)){
            $Msg[]="All fields required";
            echo json_encode($Msg);
        }
        elseif($substrDate==$Ysterday){
            $Msg[]="You can't scheduled yesterday";
            echo json_encode($Msg);
        }
        else{
            $sqlRes=mysqli_query($conn, "SELECT scheduled.*, booked.Phone FROM scheduled JOIN booked ON booked.Id=scheduled.BookedID WHERE scheduled.Id='$PIDRecords'");
            while($rows=mysqli_fetch_assoc($sqlRes)){
                $BookID=$rows['BookedID'];
                $userID=$rows['UserID'];
                $PhoneNumber=$rows['Phone'];

                $resUp=mysqli_query($conn, "UPDATE scheduled SET ScheduleDate='$PChosenDate', Status='2' WHERE Id='$PIDRecords'");
                //$resUpp=mysqli_query($conn, "UPDATE booked SET Status='2' WHERE Id='$BookID'");
                //$res=mysqli_query($conn, "INSERT INTO cancealed(DateCancealed, BookedID, UserId, Status) VALUES ('$dateToday','$BookID','$userID','0')");
                $Msg[]="Success";
                echo json_encode($Msg);
                 // Sending SMS----------------------------------------------------------------------->
                // Set your app credentials
    
     $username   = "YvesGanza";
     $apiKey     = "ee191a9544d7f11f0fa1fca03bfb35d6563d07a66390c895b6244610d56ceeef";
     
     // Initialize the SDK
     $AT         = new AfricasTalking($username, $apiKey);
     
     // Get the SMS service
     $sms        = $AT->sms();
     
     // Set the numbers you want to send to in international format
     $recipients = "+250$PhoneNumber";
     
     // Set your message
     $message    = "Muraho, Twabamenyesha ga ko gahunda yahindutse yo kubanana na Muganga  kubera {$Reason} Gahunda yimuriwe tariki ya : $PChosenDate , Murakoze Mugire Umunsi Mwiza";
     
     // Set your shortCode or senderId
     $from       = "YVESEXPRESS";
     
     try {
         // Thats it, hit send and we'll take care of the rest
         $result = $sms->send([
             'to'      => $recipients,
             'message' => $message,
             'from'    => $from
         ]);
     
        // print_r($result);
     } catch (Exception $e) {
         //echo "Error: ".$e->getMessage();
         
     }

             // Sending SMS----------------------------------------------------------------------->
               
            }
        

          
        }



}
// Get data----------------------------------------------->

if(isset($_POST['UserData'])){
    $Role=$_POST['UserData'];
    $UserID=$_POST['UserID'];
    $PDateStart=$_POST['PDateStart'];
    $PDateEnd=$_POST['PDateEnd'];
    $Msg=[];

    if($Role=="Manager" || $Role=="Receptionist"){
        $res=mysqli_query($conn, "SELECT appointment.*, users.Full_Name FROM appointment JOIN users ON appointment.UserID=users.Id WHERE FromDate BETWEEN '$PDateStart' AND  '$PDateEnd'");
        while($rows=mysqli_fetch_assoc($res)){
            $Msg[]=$rows;
        }
        echo json_encode($Msg);

    }else{
        $res=mysqli_query($conn, "SELECT appointment.*, users.Full_Name FROM appointment JOIN users ON appointment.UserID=users.Id WHERE FromDate BETWEEN '$PDateStart' AND  '$PDateEnd' AND  users.Id='$UserID'");
        while($rows=mysqli_fetch_assoc($res)){
            $Msg[]=$rows;
        }
        echo json_encode($Msg);
    }
}

if(isset($_POST['ScheduledData'])){
    $Role=$_POST['ScheduledData'];
    $UserID=$_POST['UserID'];
    $PDateStart=$_POST['PDateStart'];
    $PDateEnd=$_POST['PDateEnd'];
    $Msg=[];
    if($Role=="Manager" || $Role=="Receptionist"){
        $res=mysqli_query($conn, "SELECT scheduled.*, booked.PatientName, booked.Phone, booked.ProblemD, users.Full_Name FROM scheduled INNER JOIN booked ON booked.Id=scheduled.BookedID INNER JOIN users on users.Id=scheduled.UserID WHERE scheduled.ScheduleDate BETWEEN '$PDateStart' AND '$PDateEnd'");
        while($rows=mysqli_fetch_assoc($res)){
            $Msg[]=$rows;
        }
        echo json_encode($Msg);

    }else{
        $res=mysqli_query($conn, "SELECT scheduled.*, booked.PatientName, booked.Phone, booked.ProblemD, users.Full_Name FROM scheduled INNER JOIN booked ON booked.Id=scheduled.BookedID INNER JOIN users on users.Id=scheduled.UserID WHERE scheduled.UserID='$UserID' AND scheduled.ScheduleDate BETWEEN '$PDateStart' AND '$PDateEnd'");
        while($rows=mysqli_fetch_assoc($res)){
            $Msg[]=$rows;
        }
        echo json_encode($Msg);
    }
}
// Update save ----------------------------------------------------------->
if(isset($_POST['UpdateAvailability'])){
    $FirstDate=$_POST['UpdateAvailability'];
    $EndDate=$_POST['PEndDate'];
    $UserID=$_POST['PUserID'];
    $IDRecord=$_POST['PIDRecord'];
    $Msg=[];
    if(empty($FirstDate)|| empty($EndDate)){
        $Msg[]="All fields required";
        echo json_encode($Msg);
    }
    elseif($FirstDate>=$EndDate){
        $Msg[]="Kindly Check The First and End Date Again";
        echo json_encode($Msg);
    }
    
    else{
        $res=mysqli_query($conn, "UPDATE appointment SET FromDate='$FirstDate',EndDate='$EndDate',UserID='$UserID' WHERE Id='$IDRecord'");
        $Msg[]="Success";
        echo json_encode($Msg);
    }

}

// Delete ------------------------------------------------------------->
if(isset($_POST['DeleteApp'])){
    $IDRecord=$_POST['DeleteApp'];
    $res=mysqli_query($conn, "DELETE FROM appointment WHERE Id='$IDRecord'");
}

// Change Status ---------------------------------------------------------->

if(isset($_POST['ChangeStatus'])){
    $IDRecord=$_POST['ChangeStatus'];

    $res=mysqli_query($conn, "SELECT * FROM scheduled WHERE Id='$IDRecord'");

    while($rows=mysqli_fetch_assoc($res)){
        $Status=$rows['Status'];
        if($Status=='1'){
            $resUp=mysqli_query($conn, "UPDATE scheduled SET Status='0' WHERE Id='$IDRecord'");
        }else{
            $resUp=mysqli_query($conn, "UPDATE scheduled SET Status='1' WHERE Id='$IDRecord'");
        }
    }

}

// Delete data--------------------------------------------------------------->
/*if(isset($_POST['DeleteSchedule'])){
    $IDRecord=$_POST['DeleteSchedule'];
    $sqlRes=mysqli_query($conn, "SELECT * FROM scheduled WHERE Id='$IDRecord'");
    while($rows=mysqli_fetch_assoc($sqlRes)){
        $BookID=$rows['BookedID'];
        $resUp=mysqli_query($conn, "UPDATE scheduled SET Status='2' WHERE Id='$IDRecord'");
        $resUpp=mysqli_query($conn, "UPDATE booked SET Status='2' WHERE Id='$BookID'");
    }

    //$res=mysqli_query($conn, "DELETE FROM scheduled WHERE Id='$IDRecord'");
}*/


?>