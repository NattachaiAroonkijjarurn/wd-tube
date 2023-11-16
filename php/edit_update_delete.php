<?php

    include 'server.php';
    session_start();
    $user_id = $_SESSION['userid'];
    $video_id = $_POST['video_id'];

    if(!isset($user_id)){
    header('location:login.php');
    };

    if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:login.php');
    }

    

    if(isset($_POST['submit']))
    {

        $update = "UPDATE video SET video_name= ' ".$_POST['video_name']." ',video_description = ' ".$_POST['video_description']." ',category_id = ' ".$_POST['category_name']." ' WHERE video_id = ' ".$_POST['video_id']." '";

        $update_queary = mysqli_query($conn,$update) ;

        $affectedRows = mysqli_affected_rows($conn);
        
        if($affectedRows == 1)
        {
            $successMsg = "Record has been saved successfully";
        }
        header('location:content.php');
    }

    if (isset($_POST['delete'])) 
    {

        echo $_POST['video_id'] ;
        $delete = "DELETE FROM video WHERE video_id =' ".$_POST['video_id']." '" ;

        $delete_queary = mysqli_query($conn,$delete) ;

        header('location:content.php');
        
    }
    

    
?>