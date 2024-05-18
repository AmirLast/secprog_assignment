<?php

$conn = new mysqli("localhost", "root", "", "assignment1");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];

    $sql = "SELECT * FROM user_profile WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0){
        while($rowData = mysqli_fetch_assoc($result)){
            $username_db = $rowData["username"];
            $email_db = $rowData["email"];
        }
    }

    // Verify username and email (you would replace this with your database logic)
    if ($username === $username_db && $email === $email_db) {
        // Generate a unique token (you can use a random string generator function)
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256",$token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        // Store token in the database (you would update the user's record with this token)
        $sql="UPDATE user_profile SET token = '$token_hash', token_expiry = '$expiry' WHERE username = '$username'";
        mysqli_query($conn,$sql);

        // Send password reset email
        $subject = "Password Reset";
        // Send email using mail() or a library like PHPMailer
        //wqaizoletdvvdcbl
        // Send email
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = "54amirsyafiq@gmail.com";
        $mail->Password = "wqaizoletdvvdcbl";

        $mail->isHTML(true);

        $mail->setFrom("noreply@gmail.com");
        $mail->addAddress($email);

        $mail->Subject = $subject;
        $mail->Body = <<<END

        Click <a href="localhost/SecProg/reset_password.php?token=$token">here</a> to reset your password.

        END;
        
        $mail->send();
        // Check if the email was sent successfully
        
    }
}

echo "Message sent, please check your inbox.";

$conn->close();
?>