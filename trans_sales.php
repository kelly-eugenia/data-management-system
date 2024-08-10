<?php
include "js/connection.php";

session_start();
if(!isset($_SESSION["uid"])) {
    header("location: index.php");
} else {

if (isset($_POST["submit"])) {
    $salesID = $_POST["salesID"];
    $salesDate = $_POST["salesDate"];
    $custID = $_POST["custID"];
    $delivAddress = $_POST["delivAddress"];
    $delivDate = $_POST["delivDate"];
    $grandTotalSellPrice = $_POST["grandTotalSellPrice"];
    $grandTotalMargin = $_POST["grandTotalMargin"];
    $rowCount = $_POST["rowCount"];
    
    $conn = startConn("asherindo");
    
    $sql = "SELECT * FROM sales WHERE salesID = '".$salesID."'";
    $result = $conn->query($sql);
    if($result->num_rows<=0) {           
            
        $sql = "INSERT INTO sales (salesID,salesDate,custID,delivAddress,delivDate,grandTotalSellPrice,grandTotalMargin) VALUES('".$salesID."','".$salesDate."','".$custID."','".$delivAddress."','".$delivDate."','".$grandTotalSellPrice."','".$grandTotalMargin."')";
        $result = $conn->query($sql);
        
        if($result==TRUE) {
            echo "Database updated successfully!";
            header("location: trans_sales.php");
        }
        else {
            echo "Error: " . $sql . "<br>".$conn->error;
        }
        
        for ($i=1; $i<=$rowCount; $i++) {    
            $itemID = $_POST["itemID".$i];
            $itemQty = $_POST["itemQty".$i];
            $suppID = $_POST["suppID".$i];
            $purchasePrice = $_POST["purchasePrice".$i];
            $subTotalPurchase = $_POST["subTotalPurchase".$i];
            $sellPrice = $_POST["sellPrice".$i];
            $subTotalSell = $_POST["subTotalSell".$i];
            $margin = $_POST["margin".$i];

            $sql = "INSERT INTO sales_details (salesID,itemID,itemQty,suppID,purchasePrice,subTotalPurchase,sellPrice,subTotalSell,margin) VALUES('".$salesID."','".$itemID."','".$itemQty."','".$suppID."','".$purchasePrice."','".$subTotalPurchase."','".$sellPrice."','".$subTotalSell."','".$margin."')";
            $result = $conn->query($sql);

            if($result==TRUE) {
                echo "Database updated successfully!";
                header("location: trans_sales.php");
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
    <title>Sales Order - Asherindo</title>
    
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
  <a class="active" href="trans_sales.php"><i class='fa fa-clipboard fa-lg'></i><br>Sales Order</a>
  <a href="trans_invoice.php"><i class='fa fa-file-text fa-lg'></i><br>Invoice</a>
</div>

<!-- Page content -->
<div class="content">
  <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="text-container">
                    <h3><b>Sales Order</b></h3><br>
                </div>
            </div>
        </div>
    </div>           
                 
        <div class="container">
            <form id="salesOrder" data-toggle="validator" data-focus="false" method="post" action="trans_sales.php">
                <div class="form-group">
                    <div class="row">
                        <div class="col-25">
                            <label for="salesID">No.</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="salesID" name="salesID" class="input-field">
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-25">
                            <label for="salesDate">Date</label>
                        </div>
                        <div class="col-75">
                            <input type="date" id="salesDate" name="salesDate" class="input-field">
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-25">
                            <label for="custID">To Customer</label>
                        </div>
                        <div class="col-75">
                            <?php
                                $conn = startConn("asherindo");
                                $sql = "SELECT * FROM customer";
                                $result = $conn->query($sql);
                                ?>
                                <select class="form-control-select" id="custID" name="custID" onchange="selectCust(this.value)" required>
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-25">
                            <label for="delivAddress">Delivery Address</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="delivAddress" name="delivAddress" class="input-field" value="">
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-25">
                            <label for="delivDate">Planned Delivery Date</label>
                        </div>
                        <div class="col-75">
                            <input type="date" id="delivDate" name="delivDate" class="input-field">
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
                                        <th style="width: 12%">Item</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th style="width: 15%">Supplier</th>
                                        <th>Purchase Price</th>
                                        <th>Subtotal Purchase Price</th>
                                        <th>Selling Price</th>
                                        <th>Subtotal Selling Price</th>
                                        <th>Margin</th>
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <?php
                                            $arrid_i = array();
                                            $arrnm_i = array();
                                            $conn = startConn("asherindo");
                                            $sql = "SELECT * FROM item";
                                            $result = $conn->query($sql);
                                            ?>
                                            <select class="form-control-select" id="itemID1" name="itemID1" onchange="selectItem(this.value, 1)" required>
                                            <option class="select-option" value="">(Select Item)</option>
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        array_push($arrid_i, $row["itemID"]);
                                                        array_push($arrnm_i, $row["itemName"]);
                                                        echo "<option class='select-option' value='".$row["itemID"]."'>".$row["itemName"]." (".$row["itemID"].")</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="number" id="itemQty1" name="itemQty1" class="input-field quantity" required></td>
                                        <td><input type="text" id="itemUnit1" name="itemUnit1" class="input-field" value="" readonly></td>
                                        <td>
                                        <select class="form-control-select" id="suppID1" name="suppID1" required>
                                        <option class="select-option" value="">(Select Supplier)</option>
                                        <?php
                                        $arrid_s = array();
                                        $arrnm_s = array();
                                        $sql = "SELECT * FROM supplier";
                                        $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    array_push($arrid_s, $row["suppID"]);
                                                    array_push($arrnm_s, $row["suppName"]);
                                                    echo "<option class='select-option' value='".$row["suppID"]."'>".$row["suppName"]." (".$row["suppID"].")</option>";
                                                }
                                            }
                                        ?>
                                        </select></td>
                                        <td><input type="number" id="purchasePrice1" name="purchasePrice1" class="input-field purchaseprice" min="0" required></td>
                                        <td><input type="number" id="subTotalPurchase1" name="subTotalPurchase1" class="input-field totalpurchase"></td>
                                        <td><input type="number" id="sellPrice1" name="sellPrice1" class="input-field sellprice" min="0" required></td>
                                        <td><input type="number" id="subTotalSell1" name="subTotalSell1" class="input-field totalsell"></td>
                                        <td><input type="number" id="margin1" name="margin1" class="input-field margin" ></td>
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
                            <label for="grandTotalSellPrice"><b>Grand Total Selling Price</b></label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="grandTotalSellPrice" name="grandTotalSellPrice" class="input-field gtotalsell" value="" min="0">
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-25">
                            <label for="grandTotalMargin"><b>Grand Total Margin</b></label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="grandTotalMargin" name="grandTotalMargin" class="input-field gtotalmargin" value="" min="0">
                            <input hidden type="number" id="rowCount" name="rowCount" class="input-field" value="1">
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="row">
                    <div class="col-md-12">
                    <button type="submit" name="submit" id="submit" class="form-control-submit-button">SAVE</button>
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
        var arrID_i = <?php echo json_encode($arrid_i); ?>;
        var arrName_i = <?php echo json_encode ($arrnm_i); ?>;
        var arrID_s = <?php echo json_encode($arrid_s); ?>;
        var arrName_s = <?php echo json_encode ($arrnm_s); ?>;
        var tableRow = document.getElementById("table");
        var row = tableRow.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        var cell10 = row.insertCell(9);
        var i = table.tBodies[0].rows.length;
        cell1.innerHTML = "<tr><td>"+i+"</td>";
        
        text = "<td><select class='form-control-select' id='itemID"+i+"' name='itemID"+i+"' onchange='selectItem(this.value, "+i+")' required> <option class='select-option' value=''>(Select Item)</option>";
        for(var j = 0; j < arrID_i.length; j++) {
            text += "<option class='select-option' value='"+arrID_i[j]+"'>"+arrName_i[j]+" ("+arrID_i[j]+")</option>";
        }
        text += "</select></td>";
        cell2.innerHTML = text;
        
        cell3.innerHTML = "<td><input type='number' id='itemQty"+i+"' name='itemQty"+i+"' class='input-field quantity' required></td>";
        cell4.innerHTML = "<td><input type='text' id='itemUnit"+i+"' name='itemUnit"+i+"' class='input-field' value='' readonly></td>";
        
        text = "<td><select class='form-control-select' id='suppID"+i+"' name='suppID"+i+"'required> <option class='select-option' value=''>(Select Supplier)</option>";
        for(var j = 0; j < arrID_s.length; j++) {
            text += "<option class='select-option' value='"+arrID_s[j]+"'>"+arrName_s[j]+" ("+arrID_s[j]+")</option>";
        }
        text += "</select></td>";
        cell5.innerHTML = text;
        
        cell6.innerHTML = "<td><input type='number' id='purchasePrice"+i+"' name='purchasePrice"+i+"' class='input-field purchaseprice' min='0' value='' required></td>";
        cell7.innerHTML = "<td><input type='number' id='subTotalPurchase"+i+"' name='subTotalPurchase"+i+"' class='input-field totalpurchase' value ='' readonly></td>";
        cell8.innerHTML = "<td><input type='number' id='sellPrice"+i+"' name='sellPrice"+i+"' class='input-field sellprice' min='0' value='' required></td>";
        cell9.innerHTML = "<td><input type='number' id='subTotalSell"+i+"' name='subTotalSell"+i+"' class='input-field totalsell' value='' ></td>";
        cell10.innerHTML = "<td><input type='number' id='margin"+i+"' name='margin"+i+"' class='input-field margin'></td>";
        document.getElementById("rowCount").value = i;
    }
    
    function deleteRow() {
        if (table.rows.length > 2) {
            document.getElementById("table").deleteRow(-1);
            var i = table.tBodies[0].rows.length;
            document.getElementById("rowCount").value = i;
        }
    }
    
    function selectCust(str) {
      if (str == "") {
        document.getElementById("delivAddress").value = "";
        return;
      }
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("delivAddress").value = this.responseText;
      }
      xhttp.open("GET", "sales_selectcustomer.php?q="+str);
      xhttp.send();
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
        
    $('body').on('change', '.quantity,.purchaseprice,.sellprice', function() {
    var tr = $(this).parent().parent();
    var qty = tr.find('.quantity').val();
    var purchasePrice = tr.find('.purchaseprice').val();
    var sellPrice = tr.find('.sellprice').val();
    
    var totalPurchase = qty * purchasePrice;
    var totalSell = qty * sellPrice;
    var margin = totalSell - totalPurchase;    
    tr.find('.totalpurchase').val(totalPurchase);
    tr.find('.totalsell').val(totalSell);
    totalrevenue();    
    tr.find('.margin').val(margin);
    totalmargin();
  });

  function totalrevenue() {
    var tr = 0;
    $('.totalsell').each(function(i) {
      var sellPrice = $(this).val() - 0;
      tr += sellPrice;
    });
    $('.gtotalsell').val(tr);
  }
  function totalmargin() {
    var tm = 0;
    $('.margin').each(function(i) {
      var margin = $(this).val() - 0;
      tm += margin;
    });
    $('.gtotalmargin').val(tm);
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