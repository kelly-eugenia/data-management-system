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
    $itemID = $_POST["itemID"];
    $itemName = $_POST["itemName"];
    $itemUnit = $_POST["itemUnit"];
    $suppID = $_POST["suppID"];
    $purchasePrice = $_POST["purchasePrice"];
    
    $sql = "UPDATE item SET itemName='".$itemName."',itemUnit='".$itemUnit."' WHERE itemID='".$itemID."'";
    $sql2 = "UPDATE item_details SET purchasePrice='".$purchasePrice."' WHERE itemID='".$itemID."' AND suppID='".$suppID."'";
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
        
    if(($result==TRUE) && ($result2==TRUE)) {
        echo "Your data has been edited successfully!";
        header("location: master_item.php");
    }
    else {
        echo "Error: " . $sql . $sql2 . "<br>".$conn->error;
    }
} else if(isset($_POST["cancel"])) {
    header("location: master_item.php");
} else {
    //displaying the form input
    $id = $_GET["id"];
    $suppID = $_GET["sid"];
    $sql = "SELECT * FROM ((item i INNER JOIN item_details d ON i.itemID = d.itemID) INNER JOIN supplier s ON d.suppID = s.suppID) WHERE i.itemID='$id' AND d.suppID = '$suppID'";
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
    <div id="adddata" class="lightbox-basic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3><b>Edit Item</b></h3>
                    <hr>
                    <form id="itemEdit" data-toggle="validator" data-focus="false" method="post" action="edit_item.php">
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "itemID" id="itemID" value="<?php echo $data["itemID"]?>" readonly>
                                <label class="label-ctrl" for="itemID">ID</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "itemName" id="itemName" value="<?php echo $data["itemName"]?>" required>
                                <label class="label-ctrl" for="itemName">Name</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "itemUnit" id="itemUnit" value="<?php echo $data["itemUnit"]?>" required>
                                <label class="label-ctrl" for="itemUnit">Unit</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "suppID" id="suppID" value="<?php echo $data["suppID"]?>" readonly>
                                <label class="label-ctrl" for="itemID">Supplier</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control-input" name = "purchasePrice" id="purchasePrice" value="<?php echo $data["purchasePrice"]?>" required>
                                <label class="label-ctrl" for="purchasePrice">Purchase Price</label>
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