<?php
    require 'database.php';

    $message = '';

    if (!empty($_POST['email']) && !empty($_POST['contrasena'])) {
        $sql = "INSERT INTO users (email, password) VALUES (:email, :contrasena)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
        $stmt->bindParam(':contrasena', $password);

        if ($stmt->execute()) {
            $message = 'Successfully created new user';
        } else {
            $message = 'Sorry there must have been an issue creating your account';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <?php require "partials/header.php" ?>

        <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>

        <h1>Signup</h1>
        <span>or <a href="login.php">Login</a></span>
        
        <form action="signup.php" method="post" >
            <input type="text" name="email" placeholder="Enter your email">
            <input type="password" name="contrasena" placeholder="Enter your password">
            <input type="password" name="confirm_password" placeholder="Confirm your password">
            <input type="submit" value="send">
        </form>
    </body>
</html>