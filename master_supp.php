<?php
include "js/connection.php";

session_start();
if(!isset($_SESSION["uid"])) {
    header("location: index.php");
} else {

if (isset($_POST["submit"])) {
    $suppID = $_POST["suppID"];
    $suppName = $_POST["suppName"];
    $suppAddress = $_POST["suppAddress"];
    $suppDelivAddr = $_POST["suppDelivAddr"];
    $suppContactP = $_POST["suppContactP"];
    $suppPhone = $_POST["suppPhone"];
    $suppNPWP = $_POST["suppNPWP"];
    $conn = startConn("asherindo");
    
    $sql = "SELECT * FROM supplier WHERE suppID = '".$suppID."'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result)<=0) {
        
        $sql = "INSERT INTO supplier (suppID,suppName,suppAddress,suppDelivAddr,suppContactP,suppPhone,suppNPWP) VALUES('".$suppID."','".$suppName."','".$suppAddress."','".$suppDelivAddr."','".$suppContactP."','".$suppPhone."','".$suppNPWP."')";
        $result = $conn->query($sql);
        
        if($result==TRUE) {
            echo "Database updated successfully!";
            header("location: master_supp.php");
        }
        else {
            echo "Error: " . $sql . "<br>".$conn->error;
        }
    }
    else {
        echo "<script>alert('This ID already exists.')</script>";
    }
} else {
    //displaying the form input
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
    
.sidebar {
  margin: 0;
  padding: 0;
  width: 120px;
  background-color: #3B5D9D;
  position: fixed;
  height: 100%;
  overflow: auto;
}

/* Sidebar links */
.sidebar a {
  display: block;
  color: #F5F5F6;
  padding: 16px;
  text-align: center;
  text-decoration: none;
}

/* Active/current link */
.sidebar a.active {
  background-color: #5C7CB2;
  color: #F5F5F6;
}

/* Links on mouse-over */
.sidebar a:hover:not(.active) {
  background-color: #25488B;
  color: #F5F5F6;
}

/* Page content. The value of the margin-left property should match the value of the sidebar's width property */
div.content {
  margin-left: 120px;
  padding: 1px 16px;
  height: 1000px;
}

.input-icons i {
    position: absolute;
}
          
.input-icons {
    width: 100%;
    margin-bottom: 10px;
}
          
.icon {
    padding: 10px;
    min-width: 40px;
}
          
.input-field {
    width: 30%;
    padding-top: 0.0625rem;
	padding-bottom: 0.0625rem;
	padding-left: 40px;
	border: 1px solid #c4d8dc;
	border-radius: 0.25rem;
	background-color: #fff;
	color: #555;
	font: 400 0.875rem/1.875rem "Open Sans", sans-serif;
	transition: all 0.2s;
	-webkit-appearance: none; /* removes inner shadow on form inputs on ios safari */
}

.btn {
	display: inline-block;
	padding: 0.95rem 1rem;
	border: 0.125rem solid #3B5D9D;
	border-radius: 0.25rem;
	background-color: #3B5D9D;
	color: #fff;
	font: 700 0.875rem/0 "Open Sans", sans-serif;
	text-decoration: none;
	transition: all 0.2s;
    float: right;
}

.btn:hover {
	background-color: transparent;
	color: #3B5D9D;
	text-decoration: none;
}
    
/* On screens that are less than 700px wide, make the sidebar into a topbar */
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

/* On screens that are less than 400px, display the bar vertically, instead of horizontally */
@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
    
</style>
    
<body data-spy="scroll" data-target=".fixed-top">
    
    <!-- Preloader -->
	<div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->
    
<!-- The sidebar -->
<div class="sidebar">
  <a href="menu.php"><i class='fa fa-home fa-lg'></i></a>
  <a class="active" href="master_supp.php"><i class='fa fa-truck fa-lg'></i><br>Supplier</a>
  <a href="master_cust.php"><i class='fa fa-users fa-lg'></i><br>Customer</a>
  <a href="master_item.php"><i class='fa fa-archive fa-lg'></i><br>Item</a>
</div>

<!-- Page content -->
<div class="content">
  <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <h3><b>Supplier</b></h3><br>
                </div>
            </div>
        </div>
    </div>           
   
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

    <div class="input-icons">
        <i class="fa fa-search icon"></i> 
        <input type="text" name="search" id="search" class="input-field" placeholder="Search...">
        <a class="btn popup-with-move-anim" href="#adddata">+ ADD DATA</a>
    </div>
            </div>
        </div>
    </div> 
    
        <!-- Table -->    
        <div id="search_result" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="w3-responsive">
                    <table class="w3-table-all w3-hoverable">
                        <thead>
                            <tr class="w3-light-grey">
                                <th> </th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Delivery Address</th>
                                <th>Contact Person</th>
                                <th>Phone Number</th>
                                <th>NPWP</th>
                            </tr>
                        </thead>
                            <tr>
                            <?php
                            $conn = startConn("asherindo");
                            $sql = "SELECT * FROM supplier";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "
                                    <td> <a href='edit_supp.php?id=".$row['suppID']."'><i class='fa fa-edit fa-lg'></i></a>  <a href='delete_supp.php?id=".$row['suppID']."'><i class='fa fa-trash-o fa-lg' style='color:red'></i></a></td>
                                    <td>" . $row["suppID"]. "</td>
                                    <td>" . $row["suppName"]. "</td>
                                    <td>" . $row["suppAddress"]. "</td>
                                    <td>" . $row["suppDelivAddr"]. "</td>
                                    <td>" . $row["suppContactP"]. "</td>
                                    <td>" . $row["suppPhone"]. "</td>
                                    <td>" . $row["suppNPWP"]. "</td>
                                    </tr>
                                    ";
                                }
                            }
                            $conn->close();
                        ?> 
                            </tr>
                    </table>
                    </div>
                </div> 
            </div> 
        </div> 
    </div>
    <!-- end of table -->

    <div id="adddata" class="lightbox-basic zoom-anim-dialog mfp-hide">
        <div class="container">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-12">
                    <h3><b>Add Supplier</b></h3>
                    <hr>
                    <form id="suppAdd" data-toggle="validator" data-focus="false" method="post" action="master_supp.php">
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "suppID" id="suppID" required>
                                <label class="label-control" for="suppID">ID</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "suppName" id="suppName" required>
                                <label class="label-control" for="suppName">Name</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "suppAddress" id="suppAddress" required>
                                <label class="label-control" for="suppAddress">Address</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "suppDelivAddr" id="suppDelivAddr" required>
                                <label class="label-control" for="suppDelivAddr">Delivery Address</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "suppContactP" id="suppContactP" required>
                                <label class="label-control" for="suppContactP">Contact Person</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "suppPhone" id="suppPhone" required>
                                <label class="label-control" for="suppPhone">Phone Number</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control-input" name = "suppNPWP" id="suppNPWP" required>
                                <label class="label-control" for="suppNPWP">NPWP</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="form-control-submit-button">SAVE</button>
                            </div>
                            <div class="form-message">
                                <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                            </div>
                        </form>
                </div> 
            </div> 
        </div> 
    </div> 

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#search").keyup(function () {
                var query = $(this).val();
                $.ajax({
                    url: 'getsupp.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function (data) {
                        $('#search_result').html(data);
                        $('#search_result').css('display', 'block');
                        $("#search").focusout(function () {
                            $('#search_result').css('display', 'block');
                        });
                        $("#search").focusin(function () {
                            $('#search_result').css('display', 'block');
                        });
                    }
                });
            });
        });
    </script>
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