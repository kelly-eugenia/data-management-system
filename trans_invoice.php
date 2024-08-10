<?php
include "js/connection.php";

session_start();
if(!isset($_SESSION["uid"])) {
    header("location: index.php");
} else {

if (isset($_POST["submit"])) {
    $invoiceID = $_POST["invoiceID"];
    $invoiceDate = $_POST["invoiceDate"];
    $custID = $_POST["custID"];
    $invoiceGrandTotal = $_POST["invoiceGrandTotal"];
    $note = $_POST["note"];
    $rowCount = $_POST["rowCount"];
    
    $conn = startConn("asherindo");
    
    $sql = "SELECT * FROM invoice_header WHERE invoiceID = '".$invoiceID."'";
    $result = $conn->query($sql);
    if($result->num_rows<=0) {           
            
        $sql = "INSERT INTO invoice_header (invoiceID,invoiceDate,custID,invoiceGrandTotal,note) VALUES('".$invoiceID."','".$invoiceDate."','".$custID."','".$invoiceGrandTotal."','".$note."')";
        $result = $conn->query($sql);
        
        if($result==TRUE) {
            echo "Database updated successfully!";
        }
        else {
            echo "Error: " . $sql . "<br>".$conn->error;
        }
        
        for ($i=1; $i<=$rowCount; $i++) {    
            $itemID = $_POST["itemID".$i];
            $itemQty = $_POST["itemQty".$i];
            $itemPrice = $_POST["itemPrice".$i];
            $itemSubTotal = $_POST["itemSubTotal".$i];

            $sql = "INSERT INTO invoice_details (invoiceID,itemID,itemQty,itemPrice,itemSubTotal) VALUES('".$invoiceID."','".$itemID."','".$itemQty."','".$itemPrice."','".$itemSubTotal."')";
            $result = $conn->query($sql);

            if($result==TRUE) {
                echo "Database updated successfully!";
                header("location: preview_invoice.php?id=$invoiceID");
            }
            else {
                echo "Error: " . $sql . "<br>".$conn->error;
            }
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
    <title>Invoice - Asherindo</title>
    
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

.btn {
	display: inline-block;
	padding: 8px;
	border-radius: 0.25rem;
	background-color: #fff;
	color: #3B5D9D;
	font: 700 0.875rem/0 "Open Sans", sans-serif;
	text-decoration: none;
	transition: all 0.2s;
    float: right;
}

.btn:hover {
	background-color: #3B5D9D;
	color: #fff;
	text-decoration: none;
}
    
.input-field {
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
      th.wide {
        width: 50%;
    }
    th.semi {
        width: 30%;
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
  <a href="trans_sales.php"><i class='fa fa-clipboard fa-lg'></i><br>Sales Order</a>
  <a class="active" href="trans_invoice.php"><i class='fa fa-file-text fa-lg'></i><br>Invoice</a>
</div>

<!-- Page content -->
<div class="content">
  <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <h3><b>Invoice</b></h3><br>
                </div>
            </div>
        </div>
    </div>           
                 
    <div class="container">
        <form id="invoice" data-toggle="validator" data-focus="false" method="post" action="trans_invoice.php">
            <div class="form-group">
                <div class="row">
                    <div class="col-25">
                        <label for="invoiceID">No.</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="invoiceID" name="invoiceID" class="input-field">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-25">
                        <label for="invoiceDate">Date</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="invoiceDate" name="invoiceDate" class="input-field">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-25">
                        <label for="custID">Customer</label>
                    </div>
                    <div class="col-75">
                        <?php
                            $conn = startConn("asherindo");
                            $sql = "SELECT * FROM customer";
                            $result = $conn->query($sql);
                            ?>
                            <select class="form-control-select" id="custID" name="custID" required>
                            <option class="select-option" value="">(Select Customer)</option>
                                <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option class='select-option' value='".$row["custID"]."'>".$row["custName"]." (".$row["custID"].")</option>";
                                    }
                                }
                                ?>
                            </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>            
            <br>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="w3-responsive">
                        <table id="table" class="table w3-table-all w3-hoverable">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>No</th>
                                    <th style="width:25%">Item</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Item Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                                <tr>
                                    <td>1</td>
                                    <td>
                                    <?php
                                    $arrid = array();
                                    $arrnm = array();
                                    $conn = startConn("asherindo");
                                    $sql = "SELECT * FROM item";
                                    $result = $conn->query($sql);
                                    ?>
                                    <select class="form-control-select" id="itemID1" name="itemID1" onchange="selectItem(this.value, 1)" required>
                                    <option class="select-option" value="">(Select Item)</option>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                array_push($arrid, $row["itemID"]);
                                                array_push($arrnm, $row["itemName"]);
                                                echo "<option class='select-option' value='".$row["itemID"]."'>".$row["itemName"]." (".$row["itemID"].")</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    </td>
                                    <td><input type="number" id="itemQty1" name="itemQty1" class="input-field quantity" required></td>
                                    <td><input type="text" id="itemUnit1" name="itemUnit1" class="input-field" value="" readonly></td>
                                    <td><input type="number" id="itemPrice1" name="itemPrice1" class="input-field price" min="0" required></td>
                                    <td><input type="number" id="itemSubTotal1" name="itemSubTotal1" class="input-field tprice" readonly></td>
                                </tr>
                        </table>
                        </div>
                        <button type="button" class="btn" onclick="addRow()"><i class="fa fa-plus"></i></button>  <button type="button" class="btn" onclick="deleteRow()"><i class="fa fa-minus"></i></button>
                    </div>
                    <div class="help-block with-errors"></div>
                 </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-25">
                        <label for="invoiceGrandTotal"><b>Grand Total</b></label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="invoiceGrandTotal" name="invoiceGrandTotal" class="input-field gtotal" value="" min="0">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="row">
                    <div class="col-25">
                        <label for="note">Note<br>(optional)</label>
                    </div>
                    <div class="col-75">
                        <textarea id="note" name="note" class="input-field-text"></textarea>
                        <input hidden type="number" id="rowCount" name="rowCount" class="input-field" value="1">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                    <div class="row">
                    <div class="col-md-12">
                    <button type="submit" name="submit" id="submit" class="form-control-submit-button">SAVE AND PREVIEW</button>
                    </div>
                    </div>
                </div>
            <div class="form-message">
                <div id="nmsgSubmit" class="h3 text-center hidden"></div>
            </div>
        </form>
    </div>
    </div>
    </body>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    var i = table.tBodies[0].rows.length;
    
    function addRow() {
        let text = "";
        var arrID = <?php echo json_encode($arrid); ?>;
        var arrName = <?php echo json_encode ($arrnm); ?>;
        var tableRow = document.getElementById("table");
        var row = tableRow.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var i = table.tBodies[0].rows.length;
        cell1.innerHTML = "<tr><td>"+i+"</td>";
        text = "<td><select class='form-control-select' id='itemID"+i+"' name='itemID"+i+"' onchange='selectItem(this.value, "+i+")' required> <option class='select-option' value=''>(Select Item)</option>";
        for(var j = 0; j < arrID.length; j++) {
            text += "<option class='select-option' value='"+arrID[j]+"'>"+arrName[j]+" ("+arrID[j]+")</option>";
        }
        text += "</select></td>";
        cell2.innerHTML = text;
        cell3.innerHTML = "<td><input type='number' id='itemQty"+i+"' name='itemQty"+i+"' class='input-field quantity' required></td>";
        cell4.innerHTML = "<td><input type='text' id='itemUnit"+i+"' name='itemUnit"+i+"' class='input-field' value='' readonly></td>";
        cell5.innerHTML = "<td><input type='number' id='itemPrice"+i+"' name='itemPrice"+i+"' class='input-field price' min='0' required></td>";
        cell6.innerHTML = "<td><input type='number' id='itemSubTotal"+i+"' name='itemSubTotal"+i+"' class='input-field tprice' value ='' readonly></td>";
        document.getElementById("rowCount").value = i;
    }
    function deleteRow() {
        if (table.rows.length > 2) {
            document.getElementById("table").deleteRow(-1);
            var i = table.tBodies[0].rows.length;
            document.getElementById("rowCount").value = i;
        }
    }
        
    function selectItem(str, i) {
      if (str == "") {
        document.getElementById("itemUnit"+i).value = "";
        return;
      }
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("itemUnit"+i).value = this.responseText;
      }
      xhttp.open("GET", "sales_selectitem.php?q="+str);
      xhttp.send();
    }
        
    $('body').on('change', '.quantity,.price', function() {
    var tr = $(this).parent().parent();
    var qty = tr.find('.quantity').val();
    var price = tr.find('.price').val();
    
    var subtotal = qty * price;
    tr.find('.tprice').val(subtotal);
    total();    
  });

  function total() {
    var t = 0;
    $('.tprice').each(function(i, e) {
      var subtotal = $(this).val() - 0;
      t += subtotal;
    });
    $('.gtotal').val(t);
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
</html>
<?php
}
}
?>