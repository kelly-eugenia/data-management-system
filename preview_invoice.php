<?php
include "js/connection.php";

session_start();
if(!isset($_SESSION["uid"])) {
    header("location: index.php");
} else {
    
$conn = startConn("asherindo");
$invoiceID = $_GET['id'];
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
    <title>Preview Invoice - Asherindo</title>
    
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
.details {
    border: 1px solid black;
    width: 45%;
    float: left;
    padding: 20px;
    box-sizing: border-box;
    margin-right: 10px;
    margin-left: 10px;
}

.customer {
    border: 1px solid black;
    width: 45%;
    float: right;
    padding: 20px;
    box-sizing: border-box;
    margin-right: 10px;
    margin-left: 10px;
}
    
.items {
    border: 1px solid black;
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
    margin-right: 10px;
    margin-left: 10px;
}

.grandtotal {
    width: 100%;
    display: inline-block;
    background-color: lightgrey;
    padding: 10px;
}
.bank {
    float: left;
    display: inline-block;
    
}
.signature {
    float: right;
    text-align: center;
    display: inline-block;
    
}

img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%
}
    
.btn {
	display: inline-block;
	padding: 0.95rem 1rem;
	border: 0.125rem solid #3B5D9D;
	border-radius: 0.25rem;
	background-color: #3B5D9D;
	color: #fff;
	font: 700 1rem/0 "Open Sans", sans-serif;
	text-decoration: none;
	transition: all 0.2s;
    float: right;
}

.btn:hover {
	background-color: transparent;
	color: #3B5D9D;
	text-decoration: none;
}

.container-box {
    border: 1px solid black;
    width: 50%;
    height: auto;
    padding: 20px;
    margin-left: auto;
    margin-right: auto;
    
}
</style>
    
<body>
    <br>
<div class="container">
    <div class="container-box">
    <div id="invoice">
        <br>
        <img src="images/invoice header.png">
        <div class="row">
            <div class="col-lg-12">
                <div class="details">
                    <?php
                    $sql = "SELECT * FROM (invoice_header h INNER JOIN customer c ON h.custID = c.custID) WHERE invoiceID = '".$invoiceID."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<p>No. Invoice:  ".$row["invoiceID"]."</p>
                                <p>Date:  ".$row["invoiceDate"]."</p>";
                                $invoiceDate = $row["invoiceDate"];
                    ?>
                </div>
                <div class="customer">
                    <?php
                        echo "<p><u>To:</u></p>
                        <p>".$row["custName"]."</p>
                        <p>".$row["custAddress"]."</p>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <br>
        <div class="items">
            <div class="row">
                <div class="col-lg-12">
                    <p><b><u>Item details</u></b></p>
                    <div class="w3-responsive">
                        <table class="w3-table-all w3-hoverable">
                            <thead>
                                <tr class="w3-light-grey">
                                    <th>No.</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Price per Unit</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                                <tr>
                                <?php
                                $sql = "SELECT * FROM (invoice_details d INNER JOIN item i ON d.itemID = i.itemID) WHERE d.invoiceID = '".$invoiceID."'";
                                $result = $conn->query($sql);
                                $index = 1;
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "
                                        <td>" . $index . "</td>
                                        <td>" . $row["itemName"]. "</td>
                                        <td>" . $row["itemQty"]. "</td>
                                        <td>" . $row["itemUnit"]. "</td>
                                        <td>" . $row["itemPrice"]. "</td>
                                        <td>" . $row["itemSubTotal"]. "</td>
                                        </tr>
                                        ";
                                    $index = $index + 1;
                                    }
                                }
                                ?> 
                                </tr>
                        </table>
                    </div>
                    <br>
                    <p style="float:left"><b>Grand Total</b></p>
                    <?php
                        $sql = "SELECT * FROM invoice_header WHERE invoiceID = '".$invoiceID."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<p style='float:right'><b>".$row["invoiceGrandTotal"]."</b></p>";
                            
                        
                    ?>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $note = $row["note"];
                    if($note!=NULL) {
                        echo "<p><i>Note:<br>".$note."</i></p><br><br>";
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="bank">
                    <p>Please transfer to the following account:</p><br>
                    <p>Bank ABC <br> No. A/C: 000000000 <br> A/C Name: PT. Asherindo Duta Pratama</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="signature">
                    <p>Surabaya, <?php echo $row["invoiceDate"]; }} ?></p><br>
                    <p>Best Regards,</p><br><br><br><br>
                    <p><u>  (Authorized Name)  </u></p>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br><br>
    <button class="btn" onclick="generatePDF()">DOWNLOAD AS PDF</button>
    <br><br><br>
</div>
</body>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
window.jsPDF = window.jspdf.jsPDF;

function generatePDF() {
    var doc = new jsPDF();

    // Source HTMLElement or a string containing HTML.
    var elementHTML = document.querySelector("#invoice");

    doc.html(elementHTML, {
        callback: function(doc) {
            // Save the PDF
            doc.save("invoice.pdf");
            window.location.href = "trans_invoice.php";
        },
        margin: [10,10,10,10],
        autoPaging: "text",
        x: 0,
        y: 0,
        width: 190, //target width in the PDF document
        windowWidth: 675 //window width in CSS pixels
    });
}
</script>
<?php
}
?>