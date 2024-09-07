<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Houses</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h1 class="text-center mb-4">Available Houses</h1>
    <div class="row">
        <?php
        // Connect to database
        $con = mysqli_connect("localhost", "root", "", "company");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to select all houses
        $select = mysqli_query($con, "SELECT * FROM houses");
        $num = mysqli_num_rows($select);

        // Check if there are any results
        if ($num > 0) {
            // Loop through each house
            while ($data = mysqli_fetch_array($select)) {
                // Generate link based on houseID
                $house_link = "house-details.php?id=" . $data['houseID'];
        ?>
                <div class="col-md-4 mb-4">
                    <!-- Link to house details -->
                    <a href="<?php echo $house_link; ?>" class="text-decoration-none">
                        <div class="card h-100 shadow-sm">
                            <img src="./images/<?php echo $data['image']; ?>" class="card-img-top" alt="<?php echo $data['house_name']; ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['house_name']; ?></h5>
                                <p class="card-text">
                                    <strong>Location:</strong> <?php echo $data['location']; ?><br>
                                    <strong>No of Rooms:</strong> <?php echo $data['number_of_rooms']; ?><br>
                                    <strong>No of Bedrooms:</strong> <?php echo $data['num_of_bedrooms']; ?><br>
                                    <strong>Rent:</strong> $<?php echo $data['rent_amount']; ?><br>
                                    <strong>Status:</strong> <?php echo $data['house_status']; ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
        <?php
            }
        } else {
            echo "<div class='col-12 text-center'><p>No houses found</p></div>";
        }

        // Close the database connection
        mysqli_close($con);
        ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
