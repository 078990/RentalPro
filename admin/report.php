<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- Fonts -->
    <title>Premier Real Estate</title>
</head>

<style type="text/css">
    body {
        background-image: url('images/bg.jpg');
    }

    .content {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.5cm;
        min-width: 300px;
        border-bottom: 1px solid #dddddd;
    }

    th {
        background-color: black;
        color: white;
        text-align: left;
        font-weight: bold;
    }

    table {
        align-content: center;
    }

    h1 {
        text-align: center;
        color: chocolate;
    }
</style>

<body>
    <!-- Page Loader -->

    <center>
        <h1>View Client's Information</h1><br>
        <table border="2" class="content">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Names</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Actions</th> <!-- New Actions column -->
                </tr>
            </thead>
            <tbody>
                <?php 
                $con = mysqli_connect("localhost", "root", "", "company");
                $select = mysqli_query($con, "SELECT * FROM clients");
                $num = mysqli_num_rows($select);

                if ($num > 0) {
                    while ($data = mysqli_fetch_array($select)) {
                ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['names']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td>
                                <!-- Action buttons for Edit and Delete -->
                                <a href="respond.php?id=<?php echo $data['id']; ?>" style="color: green;">respond</a> |
                                
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>There is no data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </center>
</body>

</html>
