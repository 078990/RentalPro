<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="images/radis.jpg"> <!-- This line seems incorrect, it should probably be removed or replaced with a valid stylesheet link if needed -->
    <title>Premier Real Estate</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Coalition Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- //custom-theme -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- js -->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <!-- //js -->
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
    <!-- font-awesome-icons -->
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- //font-awesome-icons -->
    <link href="//fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('./images/bgg.jpg'); /* Path to your background image */
            background-size: cover; /* Makes sure the image covers the whole background */
            background-position: center; /* Centers the background image */
            background-repeat: no-repeat; /* Prevents the image from repeating */
        }
        .header-top {
            background-color: #000; /* Black background */
            color: #fff; /* White text */
            padding: 10px 20px;
        }
        .header-top ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: flex-start;
        }
        .header-top ul li {
            margin-right: 20px;
            display: flex;
            align-items: center;
        }
        .header-top ul li i {
            margin-right: 8px;
        }
        .banner {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }
        .banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }
        .banner .navbar {
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1;
        }
        .banner .logo {
            position: absolute;
            top: 10px;
            left: 20px;
            z-index: 1;
        }
        .banner .logo img {
            max-height: 50px;
        }
        .banner .navbar-nav {
            display: flex;
            justify-content: center;
            width: 100%;
            position: relative;
        }
        .banner .navbar-nav li {
            margin: 0 15px;
        }
        .banner .navbar-nav .nav-link {
            color: #fff;
        }
        /* Add CSS to make the "Available Houses" text white */
        .container h1 {
            color: #fff; /* White color for the heading */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Optional: Adds a subtle shadow for better readability */
        }
    </style>
</head>
<body>
    <!-- Header Top -->
    <div class="header-top">
        <ul>
            <li><i class="fa fa-phone" aria-hidden="true"></i>+(250) 786697640</li>
            <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:inestoni25@gmail.com" style="color: #fff; text-decoration: none;">inestoni25@gmail.com</a></li>
        </ul>
    </div>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="images/logo.jpg" class="img-responsive">
        </div>
    </header>
    <!-- Banner -->
    <div class="banner">
        <img src="./images/radis.jpg" alt="Radis Image">
        <div class="container">
            <div class="agileits_w3layouts_banner_nav">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                                <li class="nav-item"><a class="nav-link" href="portfolio.php">Products</a></li>
                                <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="wthree_banner_info">
                <section class="slider">
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <h3>WELCOME TO KIGALI</h3>
                                <p> Premier real estate is a boutique real estate firm in Kigali, Rwanda specialized in commercial and residential rental.</p>
                            </li>
                            <li>
                                <h3>Our Mission.. </h3>
                                <p><b>Home is more than a place, it's a feeling.</b></p>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- flexSlider -->
                <script defer src="js/jquery.flexslider.js"></script>
                <script type="text/javascript">
                $(window).load(function(){
                  $('.flexslider').flexslider({
                    animation: "slide",
                    start: function(slider){
                      $('body').removeClass('loading');
                    }
                  });
                });
                </script>
                <!-- //flexSlider -->
            </div>
        </div>
    </div>
    <!-- //banner -->

    <!-- content -->
    <div class="process all_pad agileits">
        <?php
        if (isset($_GET["subscribed"])) {
            echo 
            '<div class="alert alert-success" >
                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                <strong>SUBSCRIBED!! </strong><p> Thank you for subscribing with us. We will keep you informed on what is happening with Company.</p>
            </div>';
        }
        elseif (isset($_GET["fail"])) {
            echo 
            '<div class="alert alert-danger" >
                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                <strong>Ooops!! </strong><p> Looks like you are already subscribed to our mailing list :) </p>
            </div>';
        }
        ?>    
        <h1 class="text-center mb-4">Available Houses</h1>
    </div>  
    <div class="container my-5">
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
                while ($row = mysqli_fetch_array($select)) {
                    // Generate link based on houseID
                    $house_link = "admin/house-details.php?houseID=" . $row['houseID'];
            ?>
                <div class="col-md-4 mb-4">
                    <!-- Link to house details -->
                    <a href="<?php echo $house_link; ?>" class="text-decoration-none">
                        <div class="card h-100 shadow-sm">
                            <img src="./admin/images/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['image']; ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['house_name']; ?></h5>
                                <p class="card-text">
                                    <strong>Location:</strong> <?php echo $row['location']; ?><br>
                                    <strong>Rent amount:</strong> $<?php echo $row['rent_amount']; ?><br>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
