<?php

include 'server.php';
session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, ($_POST['password']));
    
    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    
    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['userid'] = $row['user_id'];
        header('location:home.php');
    }else{
        $message[] = 'incorrect email or password!';
    }
    
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/WDTube/css/registerlogin.css">
</head>
<body>

    <div class="header">
        <h2>Login</h2>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            }
        ?>
        <div class="input-group">
            <label for="name">Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="input-group">
            <button type="submit" name="submit" class="btn">Login</button>
        </div>
        <p>Not yet a member? <a href="/WDTube/php/register.php">Sign Up</a></p>
    </form>

</body>
</html>