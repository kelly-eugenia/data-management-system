<?php
include "js/connection.php";

session_start();
if(!isset($_SESSION["uid"])) {
    header("location: index.php");
} else {

$conn = startConn("asherindo");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    $custID = $_POST["custID"];
    $custName = $_POST["custName"];
    $custAddress = $_POST["custAddress"];
    $custDelivAddr = $_POST["custDelivAddr"];
    $custContactP = $_POST["custContactP"];
    $custPhone = $_POST["custPhone"];
    $custNPWP = $_POST["custNPWP"];
    
    $sql = "UPDATE customer SET custName='".$custName."',custAddress='".$custAddress."',custDelivAddr='".$custDelivAddr."',custContactP='".$custContactP."',custPhone='".$custPhone."',custNPWP='".$custNPWP."' WHERE custID='".$custID."'";
    $result = $conn->query($sql);
        
    if($result==TRUE) {
        echo "Your data has been edited successfully!";
        header("location: master_cust.php");
    }
    else {
        echo "Error: " . $sql . "<br>".$conn->error;
    }
} else if(isset($_POST["cancel"])) {
    header("location: master_cust.php");
} else {
    //displaying the form input
    $id = $_GET["id"];
    $sql = "SELECT * FROM customer WHERE custID='$id'";
    $result = $conn->query($sql);
    $data = $result->fetch_array(MYSQLI_ASSOC);
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
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
	<link href="css/magnific-popup.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
    <link href="css/w3.css" rel="stylesheet">
    
	
	<!-- Favicon  -->
    <link rel="icon" href="images/smallicon.png">
</head>
    
<style>
 
.label-ctrl {
	position: absolute;
    top: 0.2rem;
	left: 1.25rem;
	color: #555;
	opacity: 1;
	font: 700 0.75rem "Open Sans", sans-serif;
	cursor: text;
	transition: all 0.2s ease;
}
    
.form-control-submit-button-solid {
    display: inline-block;
    width: 100%;
	height: 3.125rem;
	border: 1px solid #3B5D9D;
	border-radius: 0.25rem;
	background-color: #3B5D9D;
	color: #fff;
	font: 700 0.875rem/0 "Open Sans", sans-serif;
	cursor: pointer;
	transition: all 0.2s;
}
.form-control-submit-button-solid:hover {
	background-color: transparent;
	color: #3B5D9D;
}    
.form-control-submit-button-outline {
    display: inline-block;
    width: 100%;
	height: 3.125rem;
	border: 1px solid #3B5D9D;
	border-radius: 0.25rem;
	background-color: transparent;
	color: #3B5D9D;
	font: 700 0.875rem/0 "Open Sans", sans-serif;
	cursor: pointer;
	transition: all 0.2s;
}
.form-control-submit-button-outline:hover {
	background-color: #3B5D9D;
	color: #fff;
}
    
</style>
    
<body>
<div class="lightbox-basic">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3><b>Edit Customer</b></h3>
                <hr>
                <form id="custEdit" data-toggle="validator" data-focus="false" method="post" action="edit_cust.php">
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "custID" id="custID" value="<?php echo $data["custID"]?>" readonly>
                            <label class="label-ctrl" for="custID">ID</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "custName" id="custName" value="<?php echo $data["custName"]?>" required>
                            <label class="label-ctrl" for="custName">Name</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "custAddress" id="custAddress" value="<?php echo $data["custAddress"]?>" required>
                            <label class="label-ctrl" for="custAddress">Address</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "custDelivAddr" id="custDelivAddr" value="<?php echo $data["custDelivAddr"]?>" required>
                            <label class="label-ctrl" for="custDelivAddr">Delivery Address</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "custContactP" id="custContactP" value="<?php echo $data["custContactP"]?>" required>
                            <label class="label-ctrl" for="custContactP">Contact Person</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "custPhone" id="custPhone" value="<?php echo $data["custPhone"]?>" required>
                            <label class="label-ctrl" for="custPhone">Phone Number</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "custNPWP" id="custNPWP" value="<?php echo $data["custNPWP"]?>" required>
                            <label class="label-ctrl" for="custNPWP">NPWP</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" id="submit" class="form-control-submit-button-solid">SAVE</button>
                            <br><br>
                            <button type="cancel" name="cancel" id="cancel" class="form-control-submit-button-outline">CANCEL</button>
                        </div>
                        <div class="form-message">
                            <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                </div>
                    </form>
            </div>
        </div> 
    </div>
</div> 

    
</body>
</html>
<?php
}
}
?>