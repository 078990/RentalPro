<?php
$pgnm = "Premier Real Estate : View Clients";
$error = ' ';

// Start output buffering
ob_start();

// Initialize the session
session_start();

// Database connection (replace with your actual connection details)
$connection = mysqli_connect("localhost", "root", "", "company");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// If session variable is not set it will redirect to login page
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("location: login.php");
    exit;
}

// Assuming the user is logged in if we reach this point
$email = $_SESSION['email'];

$sql = "SELECT * FROM `clients`";
$query = mysqli_query($connection, $sql);

/*******************************************************
                Introduce the admin header
*******************************************************/


/*******************************************************
                Add the left panel
*******************************************************/

?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo htmlspecialchars($username); ?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="#" class="active">Clients</a></li>
                    <li><a href="new-client.php">New</a></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <?php
                    echo $error;

                    if (isset($_GET["success"])) {
                        echo '<div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                <strong>DONE!! </strong><p> The new client has been added successfully.</p>
                            </div>';
                    } elseif (isset($_GET["deleted"])) {
                        echo '<div class="alert alert-warning">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                <strong>DELETED!! </strong><p> The client has been successfully deleted.</p>
                            </div>';
                    } elseif (isset($_GET["del_error"])) {
                        echo '<div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                <strong>ERROR!! </strong><p> There was an error during deleting this record. Please try again.</p>
                            </div>';
                    }
                    ?>

                    <h3 class="box-title m-b-0">Current client listings ( <span style="color: orange;"><?php echo mysqli_num_rows($query); ?></span> )</h3>
                    <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                    <div class="table-responsive">
                        <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                            <?php 
                            $rows = mysqli_fetch_all($query, MYSQLI_ASSOC); // Fetch all rows into an associative array

                            if (count($rows) == 0) {
                                echo "<i style='color:brown;'>No clients to display :( </i>";
                            } else {
                                echo '
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Names</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Names</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>';

                                foreach ($rows as $row) {
                                    echo '
                                    <tr>
                                        <td>'.htmlspecialchars($row["id"]).'</td>
                                        <td>'.htmlspecialchars($row["names"]).'</td>
                                        <td>'.htmlspecialchars($row["phone"]).'</td>
                                        <td>'.htmlspecialchars($row["email"]).'</td>
                                        <td><a href="#"><i class="fa fa-trash" data-toggle="modal" data-target="#responsive-modal'.$row["id"].'" title="remove" style="color:red;"></i></a></td>

                                        <!-- /.modal -->
                                        <div id="responsive-modal'.$row["id"].'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Are you really sure you want to delete '.$row["id"].'\'s client record?</h4>
                                                        <h5> This action could detach all tenant records linked to this client.</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="functions/respond.php" method="post">
                                                            <input type="hidden" name="id" value="'.htmlspecialchars($row["id"]).'"/>
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger waves-effect waves-light">Delete anyway</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <!-- End Modal -->
                                    </tr>';
                                }

                                echo '</tbody>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.row -->
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
    <?php require "admin_footer.php"; ?>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.print.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</div>
</body>
</html>
