<?php
include "js/connection.php";

session_start();
if(!isset($_SESSION["uid"])) {
    header("location: index.php");
} else {

$conn = startConn("asherindo");
$so = $_GET['id'];

$columns = array('i.itemID','itemQty','purchasePrice','sellPrice','margin');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

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
    <title>Sales Details - Asherindo</title>
    
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
}

.btn:hover {
	background-color: transparent;
	color: #3B5D9D;
	text-decoration: none;
}

.input-field-text {
    width: 100%;
    padding: 6px 16px;
	border: 1px solid #c4d8dc;
	border-radius: 0.25rem;
	background-color: #fff;
	color: #555;
	font: 400 0.875rem/1.875rem "Open Sans", sans-serif;
	transition: all 0.2s;
	-webkit-appearance: none; /* removes inner shadow on form inputs on ios safari */
}
    
label {
  padding: 6px;
  font: 400 0.875rem/1.5rem "Open Sans", sans-serif;
  display: inline-block;
}

.col-25 {
  float: left;
  width: 20%;
  
}

.col-75 {
  float: left;
  width: 25%;
  
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
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

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="white" href="menu.php"><i class='fa fa-home fa-2x'></i></a>
    </div>
</nav> <!-- end of navbar -->
    
<!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><b>Details of Sales ID <?php echo $so; ?> Report</b></h1>
                </div> 
            </div> 
        </div> 
    </header> 
<!-- end of header -->
  
<div class="ex-basic-2">  
    <?php
    $sql = "SELECT * FROM (sales_details s INNER JOIN item i ON s.itemID = i.itemID INNER JOIN supplier p ON s.suppID = p.suppID) WHERE salesID = '".$so."' ORDER BY ".$column." ".$sort_order;
    // Get the result...
    if ($result = $conn->query($sql)) {
        // Some variables we need for the table.
        $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    ?>
    <!-- Table -->
	<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn" href="report.php" style='float:right'>Back to Report</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="w3-responsive">
                <table class="w3-table-all w3-hoverable">
                    <thead>
                        <tr class="w3-light-grey">
                            <th>No</th>
                            <th><a href="detail_so.php?id=<?php echo $so; ?>&column=i.itemID&order=<?php echo $asc_or_desc; ?>">Item <i class="fa fa-sort<?php echo $column == 'i.itemID' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                            <th><a href="detail_so.php?id=<?php echo $so; ?>&column=itemQty&order=<?php echo $asc_or_desc; ?>">Quantity <i class="fa fa-sort<?php echo $column == 'itemQty' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                            <th>Unit</th>
                            <th>Supplier</th>
                            <th><a href="detail_so.php?id=<?php echo $so; ?>&column=purchasePrice&order=<?php echo $asc_or_desc; ?>">Purchase Price <i class="fa fa-sort<?php echo $column == 'purchasePrice' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                            <th><a href="detail_so.php?id=<?php echo $so; ?>&column=sellPrice&order=<?php echo $asc_or_desc; ?>">Sell Price <i class="fa fa-sort<?php echo $column == 'sellPrice' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                            <th><a href="detail_so.php?id=<?php echo $so; ?>&column=margin&order=<?php echo $asc_or_desc; ?>">Margin <i class="fa fa-sort<?php echo $column == 'margin' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                        </tr>
                    </thead>
                        <tr>
                        <?php
                        $i = 1;
                        if(mysqli_num_rows($result)>0){
                            while($row = $result->fetch_assoc()) {
                                    echo "
                                    <td>" .$i. "</td>
                                    <td>" . $row["itemName"]. " (" . $row["itemID"]. ")</td>
                                    <td>" . $row["itemQty"]. "</td>
                                    <td>" . $row["itemUnit"]. "</td>
                                    <td>" . $row["suppName"]. " (" . $row["suppID"]. ")</td>
                                    <td>" . $row["purchasePrice"] . "</td>
                                    <td>" . $row["sellPrice"] . "</td>
                                    <td>" . $row["margin"]. "</td>
                                    </tr>
                                    ";
                                    $i = $i + 1;
                                }
                        } else {
                            echo "<tr><td colspan='6'>No record found.</td></tr>";
                        }   
                    ?> 
                        </tr>
                </table>
                </div>
            </div> 
        </div>
        <br><br>
        <?php
        }
        ?>
    </div>
</div>

    <!-- Scripts -->
    <script>
    var i = 1;
    var totalrevenue = 0;
    var totalprofit = 0;
    $(document).ready(function(){
        var i, j = 0;
        var index = table.tBodies[0].rows.length;
        for (i=0; i<index; i++) {
            var revenue = 0;
            var profit = 0;
            var totalrevenue = totalrevenue + revenue;
            document.getElementById("totalRevenue").value = totalrevenue;

            var totalprofit = totalprofit + profit;
            document.getElementById("totalProfit").value = totalprofit;
            }
        }
    }
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
?>