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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </nav>
    <h1>Welcome to the Dashboard</h1>
    <?php if (isset($user)): ?>
        
        <p>Hello <?= htmlspecialchars($user["username"]) ?></p>

        <ul>
            <li><a href="pre_order.php">Order Food</a></li>
            <li><a href="myorder.php">See Your Order</a></li>
        </ul>
        
        
    <?php else: ?>
        
        <p><a href="login.php">Log in</a> or <a href="Assignment 1.html">sign up</a></p>
        
    <?php endif; ?>
</body>
</html>