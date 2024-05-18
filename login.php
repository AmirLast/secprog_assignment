<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user_profile
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));//prevents SQL injection
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password"])) {
            
            session_start();
            
            session_regenerate_id();// for session fixation prevention
            // The standard method is to change the session ID right after the user logs in.
            // This eliminates most session fixation vulnerabilities.
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: newpage.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="Assignment 1.html">Sign Up</a></li>
        </ul>
    </nav>
<h2>User Registration</h2>

<?php if ($is_invalid): ?>
    <em>Invalid login</em>
<?php endif; ?>

<form method="post">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <button>Log In</button>
</form>
<nav>
    <ul>
        <li><a href="pass_rec.html">forgot password | click here</a></li>
    </ul>
</nav>

</body>
</html>