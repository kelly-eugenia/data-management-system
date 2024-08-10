<?php
include "js/connection.php";
session_start();

if(isset($_POST["submit"])) {
    $user = $_POST["userID"];
    $pass = $_POST["password"];
    $conn = startConn("asherindo");
    $sql = "SELECT * FROM user WHERE userID = '".$user."' AND password = '".$pass."'";
    $result = executeQuery($conn, $sql);
    
    if ($result->num_rows > 0) {
        //create session
        $_SESSION['uid'] = $user;
        header("location: menu.php");
    }
    else {
        header("location: signuppage.php");
    }
}
else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Asherindo Data Management System">
    <meta name="author" content="Kelly Sutopo">

    <!-- Website Title -->
    <title>Log In - Asherindo</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
	<link href="css/magnific-popup.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!-- Favicon  -->
    <link rel="icon" href="images/smallicon.png">
</head>
<body scroll="no" style="overflow: hidden">
    
    <!-- Preloader -->
	<div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->


    <!-- Header -->
    <div id="header" class="form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                    <h2>Log In</h2>
                    <!-- Sign Up Form -->
                        <form id="login" data-toggle="validator" data-focus="false" method="post" action="index.php">
                            <div class="form-group">
                                <input type="text" class="form-control-input" name="userID" id="userID" required>
                                <label class="label-control" for="userID">Username</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control-input" name="password" id="password" required>
                                <label class="label-control" for="password">Password</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="form-control-submit-button">LOG IN</button>
                            </div>
                            <div class="form-message">
                                <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                            </div>
                            
                            <p class="p-center">New user? <a href="signuppage.php">Sign Up</a></p>
                            
                        </form> 
                    </div>                       
                </div> 
            </div> 
        </div> 
    </div>

    <!-- end of header -->

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>

<?php
}
?>