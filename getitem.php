<?php
  include "js/connection.php";
?>
<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="css/swiper.css" rel="stylesheet">
<link href="css/magnific-popup.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/w3.css" rel="stylesheet">
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
    float: right;
}

.btn:hover {
	background-color: transparent;
	color: #3B5D9D;
	text-decoration: none;
}
    
</style>
<body>


<div class="w3-responsive">
<?php
  $conn = startConn("asherindo");
  $query = '';
  if (isset($_POST['query'])) {
      if($_POST['query']=='') {
          $query = "SELECT * FROM ((item i INNER JOIN item_details d ON i.itemID = d.itemID) INNER JOIN supplier s ON d.suppID = s.suppID) ORDER BY i.itemID, s.suppID";
      } else {
            $query = "SELECT * FROM ((item i INNER JOIN item_details d ON i.itemID = d.itemID) INNER JOIN supplier s ON d.suppID = s.suppID) WHERE (i.itemID LIKE '%{$_POST['query']}%') OR (itemName LIKE '%{$_POST['query']}%') OR (itemUnit LIKE '%{$_POST['query']}%') OR (suppName LIKE '%{$_POST['query']}%') OR (purchasePrice LIKE '%{$_POST['query']}%') ORDER BY i.itemID, s.suppID";
      }
      $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='w3-table-all w3-hoverable'>
      <thead>
        <tr class='w3-light-grey'>
            <th> </th>
            <th>ID</th>
            <th>Name</th>
            <th>Unit</th>
            <th>Supplier</th>
            <th>Purchase Price</th>
        </tr>
    </thead>";
        while ($row = mysqli_fetch_array($result)) {
        echo "
        <td> <a href='edit_item.php?id=".$row['itemID']."'><i class='fa fa-edit fa-lg'></i></a>  <a href='delete_item.php?id=".$row['itemID']."'><i class='fa fa-trash-o fa-lg' style='color:red;'></i></a></td>
        <td>" . $row["itemID"]. "</td>
        <td>" . $row["itemName"]. "</td>
        <td>" . $row["itemUnit"]. "</td>
        <td>" . $row["suppName"]. "</td>
        <td>" . $row["purchasePrice"]. "</td>
        </tr>
        ";
      }
    } else {
      echo "<p>No matches found.</p>";
    }
    echo "</tr></table>";
  }
?>
    </div>
    </body>
</html>