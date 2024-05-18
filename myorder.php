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

//try reading the order with user's id as the id
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
    <h1><?= htmlspecialchars($user["username"]) ?> order is:</h1>
    <?php if (isset($myorder)): ?>
        
            <?php if ($myorder["item1"] !== 0): ?>
                <p>Chicken Chop: <?= ($myorder["item1"]) ?></p>
            <?php endif; ?>
            <?php if ($myorder["item2"] !== 0): ?>
                <p>Fish n Chip: <?= ($myorder["item2"]) ?></p>
            <?php endif; ?>
            <?php if ($myorder["item3"] !== 0): ?>
                <p>Spaghetti Bolognese: <?= ($myorder["item3"]) ?></p>
            <?php endif; ?>
        
    <?php else: ?>
        
        <p>You have not ordered anything yet</p><br>
        
    <?php endif; ?>
        <a href="newpage.php">go back</a></li>
</body>
</html>