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

//to check if user has ordered
if ($user["order_id"] !== NULL){
    die("you already ordered, wait for your order");
}else{//if there is no order made yet
  //create new order in myorder
  $mysqli = require __DIR__ . "/database.php";

  $sql = "INSERT INTO myorder (id, item1, item2, item3)
        VALUES (?, ?, ?, ?)";
        
  $stmt = $mysqli->stmt_init();

  if ( ! $stmt->prepare($sql)) {
      die("SQL error: " . $mysqli->error);
  }

  $zero = 0;

  $stmt->bind_param("iiii",
                  $user["id"],
                  $zero,
                  $zero,
                  $zero);
                  
  if($stmt->execute()){
    header("Location: order.php");
  };
  
}

?>