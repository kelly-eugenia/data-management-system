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
    $suppID = $_POST["suppID"];
    $suppName = $_POST["suppName"];
    $suppAddress = $_POST["suppAddress"];
    $suppDelivAddr = $_POST["suppDelivAddr"];
    $suppContactP = $_POST["suppContactP"];
    $suppPhone = $_POST["suppPhone"];
    $suppNPWP = $_POST["suppNPWP"];
    
    $sql = "UPDATE supplier SET suppName='".$suppName."',suppAddress='".$suppAddress."',suppDelivAddr='".$suppDelivAddr."',suppContactP='".$suppContactP."',suppPhone='".$suppPhone."',suppNPWP='".$suppNPWP."' WHERE suppID='".$suppID."'";
    $result = $conn->query($sql);
        
    if($result==TRUE) {
        echo "Your data has been edited successfully!";
        header("location: master_supp.php");
    }
    else {
        echo "Error: " . $sql . "<br>".$conn->error;
    }
} else if(isset($_POST["cancel"])) {
    header("location: master_supp.php");
} else {
    //displaying the form input
    $id = $_GET["id"];
    $sql = "SELECT * FROM supplier WHERE suppID='$id'";
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
                <h3><b>Edit Supplier</b></h3>
                <hr>
                <form id="suppEdit" data-toggle="validator" data-focus="false" method="post" action="edit_supp.php">
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "suppID" id="suppID" value="<?php echo $data["suppID"]?>" readonly>
                            <label class="label-ctrl" for="suppID">ID</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "suppName" id="suppName" value="<?php echo $data["suppName"]?>" required>
                            <label class="label-ctrl" for="suppName">Name</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "suppAddress" id="suppAddress" value="<?php echo $data["suppAddress"]?>" required>
                            <label class="label-ctrl" for="suppAddress">Address</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "suppDelivAddr" id="suppDelivAddr" value="<?php echo $data["suppDelivAddr"]?>" required>
                            <label class="label-ctrl" for="suppDelivAddr">Delivery Address</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "suppContactP" id="suppContactP" value="<?php echo $data["suppContactP"]?>" required>
                            <label class="label-ctrl" for="suppContactP">Contact Person</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "suppPhone" id="suppPhone" value="<?php echo $data["suppPhone"]?>" required>
                            <label class="label-ctrl" for="suppPhone">Phone Number</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" name = "suppNPWP" id="suppNPWP" value="<?php echo $data["suppNPWP"]?>" required>
                            <label class="label-ctrl" for="suppNPWP">NPWP</label>
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