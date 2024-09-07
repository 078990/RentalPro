<?php
ob_start();
require_once "functions/db.php";

// Initialize the session

if (isset($_GET['houseID'])) {
    $houseID = $_GET['houseID'];
    $sql = "SELECT * FROM houses WHERE houseID ='$houseID'";
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>


    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/roomd1.jpg');
            /* Light chocolate-like background */
            color: #333;
        }

        header {
            background-color: #8b5a2b;
            /* Darker brown for the header */
            padding: 15px 0;
        }

        header ul {
            list-style: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header ul li {
            display: inline;
            margin-right: 25px;
        }

        header ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        header ul li a:hover {
            background-color: #a0522d;
            /* Softer brown for hover effect */
            border-radius: 4px;
        }

        /* Main container for content and form */
        .container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }

        /* Left side for property details */
        .left-content {
            width: 60%;
            /* Left side occupies 60% */
        }

        .card {
            background-color: black;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Light shadow for card */
            border: 1px solid #ddd;
        }

        .card h3 {
            color: #8b5a2b;
            /* Dark brown for headings */
            margin-bottom: 15px;
        }

        .card p {
            font-size: 14px;
            font-family: sans-serif;
            width: 20%;
            line-height: 1.6;
            color: white;
            margin: 10px 0;
        }

        /* Right side for form */
        .form-container {
            width: 28%;
            /* Right side occupies 35% */
            margin-left: 30px;
        }

        .form {
            background-color: none;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form input[type="text"],
        .form input[type="number"],
        .form input[type="email"] {
            width: 50%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #bbb;
            border-radius: 4px;
            background-color: #f7f7f7;
        }

        .form button {
            padding: 12px 25px;
            background-color: #8b5a2b;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .form button:hover {
            background-color: #a0522d;
        }

        footer {
            background-color: #8b5a2b;
            padding: 20px 0;
            text-align: center;
            color: white;
            margin-top: 50px;
        }

        h4 {
            color: white;
        }

        /* Styling for the images */
        .images {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        .images img {
            width: 220px;
            /* Adjust the width of each image */
            height: auto;
            /* Maintain aspect ratio */
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>




</head>

<body>

    <header>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
            
        </ul>
    </header>

    <div class="container">
        <!-- Left Content (Property and Contact Details) -->
        <div class="left-content">
            <!-- Property Details Card -->
            <?php
            $query = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_assoc($query)) {

                echo

                ' <div class="card">
                <h3>Property details</h3>
                <p><strong>Advert type:</strong> ' . $row["house_name"] . '</p> 
                <p><strong>Price:</strong> '. $row["rent_amount"].'/month</p>
                <p><strong>Bedroom:</strong> '. $row["number_of_rooms"].'</p>
                <p><strong>Bathroom:</strong> '. $row["num_of_bedrooms"].'</p>
                <p><strong>Address:</strong> '. $row["location"].'</p>
    </div>
            <!-- Contact Details Card -->
            <div class="card">
                <h3>Contact details</h3>
                <p><strong>Contact name:</strong> Ines UMUTONI</p>
                <p><strong>Phone:</strong> 0786697640</p>
                <p><strong>Email:</strong> inestoni25@gmail.com</p>
            </div>
        </div>

        <!-- Form (Right Content) -->
        <div class="form-container">
            <div class="form">
                <h4>Interested? Get in touch!</h4>
                <form action="req.php" method="POST">
                    <input type="text" name="Names" placeholder="Names" required><br>
                    <input type="number" name="Phone" placeholder="Phone" required><br>
                    <input type="email" name="email" placeholder="Email" required><br><br>
                    <button type="submit" value="submit" name="submit">Send</button>
                </form>
            </div>
        </div>
    </div>

    
';
            }
            ?>
    <footer>
        <p>© 2024 Premier real estate | All rights reserved.</p>
    </footer>

</body>

</html>