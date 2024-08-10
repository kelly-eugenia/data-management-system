<?php
include "js/connection.php";
$conn = startConn("asherindo");

$sql = "SELECT custDelivAddr FROM customer WHERE custID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($delivAddr);
$stmt->fetch();
$stmt->close();

echo $delivAddr;
?>