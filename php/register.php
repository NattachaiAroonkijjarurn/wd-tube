<?php 

include('server.php');

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, ($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, ($_POST['cpassword']));
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name']; 
    $image_folder = 'uploaded_profile/'.$image;
    
    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    
    if(mysqli_num_rows($select) > 0){
        $message[] = 'user already exist'; 
    }else{
        if($pass != $cpass){
            $message[] = 'confirm password not matched!';
        }elseif($image_size > 5000000){
            $message[] = 'image size is too large!';
        }else{
            $insert = mysqli_query($conn, "INSERT INTO `user`(username, email, password, image) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');
    
            if($insert){
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'registered successfully!';
                header('location:login.php');
            }else{
                $message[] = 'registeration failed!';
            }
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link rel="stylesheet" href="/WDTube/css/registerlogin.css">
</head>
<body>
    
    <div class="header">
        <h2>Register</h2>
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
            <label for="username">Profile</label>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
        </div>
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" placeholder="Enter username" name="name" required>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" placeholder="Enter Email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password_1">Password</label>
            <input type="password" placeholder="Enter Password" name="password" required>
        </div>
        <div class="input-group">
            <label for="password_2">Confirm Password</label>
            <input type="password" placeholder="Confirm Password" name="cpassword" required>
        </div>
        <div class="input-group">
            <button type="submit" name="submit" class="btn">Register</button>
        </div>
        <p>Already a member? <a href="/WDTube/php/login.php">Sign in</a></p>
    </form>

</body>
</html>