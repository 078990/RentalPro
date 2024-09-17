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

    <!-- Fonts and Stylesheets -->
    <title>Premier Real Estate</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
        body {
            background-image: url('images/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .container {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #f8f9fa;
            margin-bottom: 20px;
        }

        .content {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            font-size: 16px;
            color: #f8f9fa;
        }

        th, td {
            padding: 10px;
            border: 1px solid #dddddd;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        td {
            background-color: #495057;
        }

        a {
            color: #17a2b8;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>View Client's Information</h1>

        <table class="content">
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
                            <td><?php echo htmlspecialchars($data['id']); ?></td>
                            <td><?php echo htmlspecialchars($data['names']); ?></td>
                            <td><?php echo htmlspecialchars($data['phone']); ?></td>
                            <td><?php echo htmlspecialchars($data['email']); ?></td>
                            <td>
                                <!-- Action buttons for Edit and Delete -->
                                <a href="respond.php?id=<?php echo $data['id']; ?>" class="btn btn-success btn-sm">Respond</a>  
                                <!-- wanyeretse file irimo fun -->
                            
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

        <div class="btn-container">
            <a href="index.php" class="btn btn-primary">back home</a>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
