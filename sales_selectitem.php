<?php
include "js/connection.php";
$conn = startConn("asherindo");

$sql = "SELECT itemUnit FROM item WHERE itemID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($itemUnit);
$stmt->fetch();
$stmt->close();

echo $itemUnit;
?>