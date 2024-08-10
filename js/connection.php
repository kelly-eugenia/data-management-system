<?php
	function startConn($db="", $user="root", $pass="", $host="localhost") {
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
        }
        return $conn;
    }

    //select
    function executeQuery($conn, $sql="") {
        return $conn->query($sql);
    }

    //insert, update, delete
    function executeUpdate($conn, $sql="") {
        if($conn->query($sql)===TRUE) {
            echo "Database updated successfully!";
        }
        else {
            echo "Error: " . $sql . "<br>".$conn->error;
        }
    }

    //end conn
    function endConn($conn) {
        $conn->close();
    }
?>