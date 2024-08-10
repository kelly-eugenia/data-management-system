<?php
include "js/connection.php";

session_start();
if(!isset($_SESSION["uid"])) {
    header("location: index.php");
} else {

$id = $_GET["id"];
$suppID = $_GET["sid"];


if (isset($_POST["submit"])) {
    $conn = startConn("asherindo");
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // sql to delete a record
    $sql = "DELETE FROM item_details WHERE itemID = '".$id."' AND suppID = '".$suppID."'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("location: master_item.php");
    }   else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
else if(isset($_POST["cancel"])) {
    header("location: master_item.php");
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
    <title>Master Table - Asherindo</title>
    
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
<style>
    
.form-control-submit-button-solid {
    display: inline-block;
	padding: 1.1875rem 2.125rem 1.1875rem 2.125rem;
	border: 0.125rem solid #3B5D9D;
	border-radius: 0.25rem;
	background-color: #3B5D9D;
	color: #fff;
	font: 700 0.875rem/0 "Open Sans", sans-serif;
	text-decoration: none;
	transition: all 0.2s;
}
.form-control-submit-button-solid:hover {
	background-color: transparent;
	color: #3B5D9D;
	text-decoration: none;
}    
.form-control-submit-button-outline {
    display: inline-block;
	padding: 1.1875rem 2.125rem 1.1875rem 2.125rem;
	border: 0.125rem solid #3B5D9D;
	border-radius: 0.25rem;
	background-color: transparent;
	color: #3B5D9D;
	font: 700 0.875rem/0 "Open Sans", sans-serif;
	text-decoration: none;
	transition: all 0.2s;
}
.form-control-submit-button-outline:hover {
	background-color: #3B5D9D;
	color: #fff;
	text-decoration: none;
}
    
</style>
<body data-spy="scroll" data-target=".fixed-top">

   
<div class="cards-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <br><br><br><br><br>
                <h2 class="h2-heading">Are you sure you want to delete this entry?</h2>
                <form method="post" action="delete_item.php?id=<?php echo $id; ?>&sid=<?php echo $suppID; ?>">
                    <button type="cancel" name="cancel" id="cancel" class="form-control-submit-button-outline">CANCEL</button>   <button type="submit" name="submit" id="submit" class="form-control-submit-button-solid">DELETE</button>
                </form>
                    
            </div>
        </div>
    </div> 
</div>   
    	
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
}
?>