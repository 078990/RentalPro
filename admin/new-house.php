<?php 

    //a page name
    $pgnm='Premier: Add a new house';
    $error=' ';

    //start sessions 
    ob_start();

    //require a connector
    include "functions/db.php";

    //require the global file for errors
    require_once "functions/errors.php";

    // Initialize the session
    session_start();

    // If user is not logged in, redirect to index otherwise, allow access
     if (is_logged_in_temporary()) {
        //allow access

        //take requests & actions

     /*****************************************************
                       action add a house
     ***************************************************/
    if (isset($_POST['submit'])) {
        // Gather the data
        $hname = is_username($_POST['hname']);
        $image = is_username($_POST['image']);
        $numOfRooms = uncrack($_POST['numOfRooms']);
        $numOfbRooms = uncrack($_POST['numOfbRooms']);
        $rent = uncrack($_POST['rent']);
        $location = uncrack($_POST['location']);
        $status = uncrack($_POST['status']);
        
        $timesnap = date('Y-m-d : H:i:s');
    
        // Handle the image upload
        $targetDir = "images/"; // Directory where the file will be saved
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        // Check file size (5MB max)
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // If everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $image = basename($_FILES["image"]["name"]); // Save the filename to the database
                
                // Insert the data into the houses table
                $sq = "INSERT into houses 
                        (house_name, image, number_of_rooms, rent_amount, location, num_of_bedrooms, house_status) 
                        VALUES ('$hname', '$image', '$numOfRooms', '$rent', '$location', '$numOfbRooms', '$status')";
    
                // Insert the transaction
                $sql_transactions = "INSERT into transactions 
                        (actor, time, description)
                        VALUES ('Admin ($username)', '$timesnap', '$username added a new house ($hname) with $numOfRooms rentable units, and $numOfbRooms bedrooms per unit located in $location')";
    
                $mysqli->autocommit(FALSE);
                $state = true;
    
                $mysqli->query($sq) ? null : $state = false;
                $mysqli->query($sql_transactions) ? null : $state = false;
    
                if ($state) {
                    $mysqli->commit();
                    // Redirect to the houses page with a success state
                    header('location:houses.php?state=1');
                } else {
                    // Rollback changes
                    $mysqli->rollback();
                    // Redirect to the new house page with an error state
                    header('location:new-house.php?state=2');
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    

   
    /*******************************************************
                    introduce the admin header
    *******************************************************/
    require "admin_header0.php";


    /*******************************************************
                    Add the left panel
    *******************************************************/
    require "admin_left_panel.php";

    ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo 'Hey there, '.$username;?></h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="houses.php">Houses</a></li>
                            <li><a href="new-house.php">new</a></li>

                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!--.row-->
                <div class="row">
                    <div class="col-md-12">
                        <div style="">
                            <?php 
                            echo $error;
                            ?>
                        </div>
                        <div class="white-box">
                            <h3 class="box-title m-b-0"><i class="fa fa-institution fa-3x"></i> Add A New House</h3>
                            <p class="text-muted m-b-30 font-13"> Fill in the form below: </p>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form action="new-house.php" method="post" enctype="multipart/form-data">
                                      
                                        <div class="form-group">
                                            <label for="hname">House Name: *</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                                <input type="text" required name="hname" class="form-control" id="hname" placeholder="Enter house name" required=""> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="hname">House image: *</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                                <input type="file"  name="image" class="form-control" required="" > </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="numOfRooms">Number of rooms (rentable units): *</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                                <input type="number" min="1" required name="numOfRooms" class="form-control" id="numOfRooms" placeholder="How many rooms?" required=""> </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="numOfbRooms">Number of bedrooms (per unit): *</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-bed"></i></div>
                                                <input type="number" min="0" required name="numOfbRooms" class="form-control" id="numOfbRooms" placeholder="Bedrooms. e.g. 0" required=""> </div>
                                        </div>
                       
                                        <div class="form-group">
                                            <label for="rent">Rent amount (PM): *</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                                <input type="number" required min="0" name="rent" class="form-control" id="rent" placeholder="Rent per month. e.g. 3000" required=""> </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="location">Location: *</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                                <select id="location" name="location" class="form-control">
                                                    <option value="">**Select its location**</option>
                                                    <?php
                                                        $sq0="SELECT * FROM locations order by id asc";
                                                        $rec=mysqli_query($conn,$sq0);
                                                        while ($row=mysqli_fetch_array($rec,MYSQLI_BOTH)) {
                                                            $place=$row['location_name'];
                                                            echo "<option value=\"$place\"> $place </option> ";
                                                        }
                                                        ?>
                                                </select>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">House Status: *</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-home"></i>
                                            </div>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="Vacant">Vacant</option>
                                                    <option value="Occupied">Occupied</option>
                                                </select>
                                                </div>
                                        </div>
                                    
                                      

                                        <button type="submit" name="submit" class="btn btn-success btn-lg waves-effect waves-light m-r-10 center"><i class="fa fa-plus-circle fa-lg"></i> Add this House</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
           

                </div>
                <!--./row-->
               
           
               
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul>
                                <li><b>Layout Options</b></li>
                                <li>
                                    <div class="checkbox checkbox-info">
                                        <input id="checkbox1" type="checkbox" class="fxhdr">
                                        <label for="checkbox1"> Fix Header </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox2" type="checkbox" checked="" class="fxsdr">
                                        <label for="checkbox2"> Fix Sidebar </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox4" type="checkbox" class="open-close">
                                        <label for="checkbox4"> Toggle Sidebar </label>
                                    </div>
                                </li>
                            </ul>
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" theme="blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
                                <li><b>With Dark sidebar</b></li>
                                <br/>
                                <li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
                            </ul>
                            </div>
                    </div>
                </div>
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2024 &copy; Company Admin </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/tether.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/jasny-bootstrap.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- Local Javascript -->
        <script type="text/javascript">
            
        </script>
    <!--END of local JS -->

</body>

</html>
<?php
}
else{
    header('location:../index.php');
}
?>