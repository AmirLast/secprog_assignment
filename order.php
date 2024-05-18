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

//read the order with id as user's id
  $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM myorder
            WHERE id = {$user["id"]}";
            
    $result = $mysqli->query($sql);
    
    $myorder = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <form id="ordercancel" action="cancel_order.php" method="POST">
      <button type="submit" id="submit">Cancel Ordering</button>
    </form>
    <h1>Your order?</h1>
        <ul>
            <li><a href="item1.php">Chicken Chop : </a><?= ($myorder["item1"]) ?></li>
            <li><a href="item2.php">Fish n Chip : </a><?= ($myorder["item2"]) ?></li>
            <li><a href="item3.php">Spaghetti Bolognese : </a><?= ($myorder["item3"]) ?></li>
        </ul>
    <form id="orderup" action="confirm_order.php" method="POST">
      <button type="submit" id="submit">Order Now</button>
    </form>
</body>
</html>