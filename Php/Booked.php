<?php 
include_once '../Database/Connect.php';
  //require 'vendor/autoload.php';
  require __DIR__ . '/vendor/autoload.php';
  use AfricasTalking\SDK\AfricasTalking;

if(isset($_POST['Booked'])){
    $PatientName=$_POST['Booked'];
    $Phone=$_POST['PPhone'];
    $Problem=$_POST['PProblem'];
    $dateToday=date('Y-m-d H:i:s');
    $Msg=[];
    $ThreeDigit=substr($Phone, 0,3);
    
    if(empty($Phone) || empty($Problem)){
        $Msg[]="All fields required";
        echo json_encode($Msg);
    }
    
    /* Phone Numbers Validations-----------------------------------*/
    elseif (!preg_match('/^[0-9]*$/',$Phone)){
        $Msg[]="Phone number only digit!";
        echo json_encode($Msg);
    }
    elseif(strlen($Phone)!=10){
        $Msg[]="Phone number must be 10 digit!";
        echo json_encode($Msg);
    }
    elseif($ThreeDigit!='073' && $ThreeDigit!='072' && $ThreeDigit!='078'){
        $Msg[]="Only Rwanda network!";
        echo json_encode($Msg);
    }
    elseif(strlen($Problem)>30){
        $Msg[]="Problem description should having max of 30 characters";
        echo json_encode($Msg);
    }
    else{
        $sqlsearch=mysqli_query($conn, "SELECT Full_Name FROM users WHERE Id='$PatientName'");
        while($rows=mysqli_fetch_assoc($sqlsearch)){
            $fullName=$rows['Full_Name'];
        }
        
        $res=mysqli_query($conn, "INSERT INTO booked(PatientName, Phone, ProblemD, 	BDate, PatientID) VALUES ('$fullName','$Phone','$Problem','$dateToday','$PatientName')");
        $Msg[]="Success";
        echo json_encode($Msg);
    }
   
    
    
}

//Save Scheduleds---------------------------

if(isset($_POST['PDrName'])){
    $PDrName=$_POST['PDrName'];
    $PDateSche=$_POST['PDateSche'];
    $PIDRecord=$_POST['PIDRecord'];
    $Today=new DateTime();
    $Ysterday= $Today->modify("-1 days")->format('Y-m-d');
    $substrDate=substr($PDateSche,0,10);
    $Msg=[];
  
    $res=mysqli_query($conn, "SELECT * FROM appointment WHERE UserID='$PDrName' AND '$PDateSche' BETWEEN FromDate AND EndDate");

    $resS=mysqli_query($conn, "SELECT * FROM scheduled WHERE IDRecord='$PIDRecord'");
    
   if(empty($PDrName)|| empty($PDateSche)){
        $Msg[]="All fields required";
        echo json_encode($Msg);
    }
    elseif($substrDate==$Ysterday){
        $Msg[]="You can't scheduled yesterday";
        echo json_encode($Msg);
    }
    elseif(mysqli_num_rows($res)==0){
        $Msg[]="Dr is not available on that time!";
        echo json_encode($Msg);
    }
    elseif(mysqli_num_rows($resS)>0){
        $Msg[]="This Appointment have already scheduled";
        echo json_encode($Msg);
        
    }
    
    else{
        $getPhone=mysqli_query($conn, "SELECT Phone, PatientID  FROM booked WHERE Id='$PIDRecord'");
        while($rows=mysqli_fetch_assoc($getPhone)){
            $PhoneNumber=$rows['Phone'];
            $PatientID=$rows['PatientID'];
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
     $message    = "Muraho, Twabameneyesha ko muzahura na muganga kuru yi tariki kurikira :$PDateSche , Murakoze Mugire Umunsi Mwiza";
     
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
        $res=mysqli_query($conn, "INSERT INTO scheduled(ScheduleDate, BookedID, UserID, Status, IDRecord) VALUES ('$PDateSche','$PatientID','$PDrName','0','$PIDRecord')");
             $resup=mysqli_query($conn, "UPDATE booked SET Status='1' WHERE Id='$PIDRecord'");
        
             $Msg[]="Success";
             echo json_encode($Msg);
      
       
   }


    
    
   

}

//Delete Booked Data----------------------->
if(isset($_POST['DeleteBooked'])){
    $deleteRecords=$_POST['DeleteBooked'];

    $del1=mysqli_query($conn, "DELETE FROM booked WHERE Id='$deleteRecords'");
    $del2=mysqli_query($conn, "DELETE FROM scheduled WHERE IDRecord='$deleteRecords'");
}

//UpdateScheduled
if(isset($_POST['UpdateScheduled'])){
    $PDrName=$_POST['UpdateScheduled'];
    $PDateSche=$_POST['PDateSche'];
    $PIDRecord=$_POST['PIDRecord'];
    $Today=new DateTime();
    $Ysterday= $Today->modify("-1 days")->format('Y-m-d');
    $substrDate=substr($PDateSche,0,10);
    $Msg=[];
    
    $res=mysqli_query($conn, "SELECT * FROM appointment WHERE UserID='$PDrName' AND '$PDateSche' BETWEEN FromDate AND EndDate");
    
   if(empty($PDrName)|| empty($PDateSche)){
        $Msg[]="All fields required";
        echo json_encode($Msg);
    }
    elseif($substrDate==$Ysterday){
        $Msg[]="You can't scheduled yesterday";
        echo json_encode($Msg);
    }
    elseif(mysqli_num_rows($res)==0){
        $Msg[]="Dr is not available on that time!";
        echo json_encode($Msg);
    }
   
    else{
        
        $resup=mysqli_query($conn, "UPDATE scheduled SET ScheduleDate='$PDateSche', UserID='$PDrName' WHERE Id='$PIDRecord'");
        $Msg[]="Success";
        echo json_encode($Msg);
    }


    
    
   

}

// Delete scheduled -------------------------------------------------------->
if(isset($_POST['DeleteScheduled'])){
    $PIDRecord=$_POST['DeleteScheduled'];
    $resDe=mysqli_query($conn, "SELECT * FROM scheduled WHERE Id='$PIDRecord'");
    while($rows=mysqli_fetch_assoc($resDe)){
       $IDBooked=$rows['IDRecord'];
       $update=mysqli_query($conn, "UPDATE booked SET Status='0' WHERE Id='$IDBooked'");
       $delete=mysqli_query($conn, "DELETE FROM scheduled WHERE Id='$PIDRecord'");
      
    }
    
}
// Booked Data ------------------------------------------------------------->
if(isset($_POST['BookedAll'])){
    $PDateStart=$_POST['BookedAll'];
    $PDateEnd=$_POST['PDateEnd'];
    $Msg=[];

    $res=mysqli_query($conn, "SELECT * FROM booked WHERE BDate BETWEEN '$PDateStart' AND '$PDateEnd'");
    while($rows=mysqli_fetch_assoc($res)){
        $Msg[]=$rows;
    }
    echo json_encode($Msg);
}
if(isset($_POST['ScheduledAll'])){
    $PDateStart=$_POST['ScheduledAll'];
    $PDateEnd=$_POST['PDateEnd'];
    $Msg=[];
    $res=mysqli_query($conn, "SELECT scheduled.*, booked.PatientName, booked.Phone, booked.ProblemD, users.Full_Name, booked.Status FROM scheduled INNER JOIN booked ON booked.PatientID=scheduled.BookedID INNER JOIN users on users.Id=scheduled.UserID WHERE booked.Status=1 AND scheduled.ScheduleDate BETWEEN '$PDateStart' AND '$PDateEnd'");
        while($rows=mysqli_fetch_assoc($res)){
            $Msg[]=$rows;
        }
        echo json_encode($Msg);

}
if(isset($_POST['CompleteAll'])){
    $PDateStart=$_POST['CompleteAll'];
    $PDateEnd=$_POST['PDateEnd'];
    $Msg=[];
    $res=mysqli_query($conn, "SELECT scheduled.*, booked.PatientName, booked.Phone, booked.ProblemD, users.Full_Name FROM scheduled INNER JOIN booked ON booked.Id=scheduled.BookedID INNER JOIN users on users.Id=scheduled.UserID WHERE scheduled.Status=1 AND scheduled.ScheduleDate BETWEEN '$PDateStart' AND '$PDateEnd'");
        while($rows=mysqli_fetch_assoc($res)){
            $Msg[]=$rows;
        }
        echo json_encode($Msg);

}


// Numbers --------------------------------------------

if(isset($_POST['ScheduledNumberRes'])){
    $PDateStart=$_POST['ScheduledNumberRes'];
    $PDateEnd=$_POST['PDateEnd'];
    $Msg=[];
    $res=mysqli_query($conn, "SELECT COUNT(Id) as Res FROM scheduled WHERE ScheduleDate BETWEEN '$PDateStart' AND '$PDateEnd'");
    while($rows=mysqli_fetch_assoc($res)){
        $Msg[]=$rows;
    }
    echo json_encode($Msg);
}

if(isset($_POST['CompleteNumberRes'])){
    $PDateStart=$_POST['CompleteNumberRes'];
    $PDateEnd=$_POST['PDateEnd'];
    $Msg=[];
    $res=mysqli_query($conn, "SELECT COUNT(Id) as Res, 	Status FROM scheduled WHERE Status=1 AND ScheduleDate BETWEEN '$PDateStart' AND '$PDateEnd'");
    while($rows=mysqli_fetch_assoc($res)){
        $Msg[]=$rows;
    }
    echo json_encode($Msg);
}


if(isset($_POST['BookedNumberRes'])){
    $PDateStart=$_POST['BookedNumberRes'];
    $PDateEnd=$_POST['PDateEnd'];
    $Msg=[];
    $res=mysqli_query($conn, "SELECT COUNT(Id) as Res FROM booked WHERE BDate BETWEEN '$PDateStart' AND '$PDateEnd'");
    while($rows=mysqli_fetch_assoc($res)){
        $Msg[]=$rows;
    }
    echo json_encode($Msg);
}

if(isset($_POST['ConcealedNumberRes'])){
    $PDateStart=$_POST['ConcealedNumberRes'];
    $PDateEnd=$_POST['PDateEnd'];
    $Msg=[];
    $ress=mysqli_query($conn, "SELECT COUNT(id) as Res FROM cancealed WHERE Status='0' AND DateCancealed BETWEEN '$PDateStart' AND '$PDateEnd'");
    while($rows=mysqli_fetch_assoc($ress)){
        $Msg[]=$rows;
    }
    echo json_encode($Msg);
}

// Customer Data ------------------------------------>
if(isset($_POST['PatData'])){

    $dataselect=$_POST['PatData'];
    $Msg=[];

    $sqlRes=mysqli_query($conn, "SELECT scheduled.ScheduleDate, booked.BDate, booked.ProblemD, scheduled.BookedID, booked.Status FROM scheduled JOIN booked ON booked.PatientID=scheduled.BookedID WHERE scheduled.BookedID='$dataselect' AND booked.Status=1");
    while($rows=mysqli_fetch_assoc($sqlRes)){
        $Msg[]=$rows;
    }
    echo json_encode($Msg);
    

}
?>