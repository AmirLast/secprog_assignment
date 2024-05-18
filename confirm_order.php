<?php

session_start();

if (isset($_SESSION["user_id"])) {//for session fixation
    //did not use GET method because session ID will be exposed in link
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user_profile
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

$mysqli = require __DIR__ . "/database.php";

$sql = "UPDATE user_profile SET order_id = ? WHERE id = ?";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ii", $user["id"], $user["id"]);
                  
$stmt->execute();

header("Location: myorder.php");

?>