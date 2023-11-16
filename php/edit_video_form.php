<?php

    include 'server.php';
    session_start();
    $user_id = $_SESSION['userid'];
    $video_id = $_GET["video_id"];
    $old_category_id = $_GET["category_id"];

    if(!isset($user_id)){
    header('location:login.php');
    };

    if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:login.php');
    };

    $new_ct = "SELECT * FROM category WHERE $old_category_id = category_id" ;
    $new_ct_query = mysqli_query($conn, $new_ct) ;
    $new_ct_result = mysqli_fetch_assoc($new_ct_query) ;

    $edit_video = "SELECT * 
            FROM video 
            WHERE $video_id = video_id";

    $edit_Query = mysqli_query($conn, $edit_video);

    $edit_select_Result = mysqli_fetch_assoc($edit_Query);

    if(isset($_POST['update_thumbnail'])){

        $update_image = $_FILES['thumbnail']['name'];
        $update_image_size = $_FILES['thumbnail']['size'];
        $update_image_tmp_name = $_FILES['thumbnail']['tmp_name'];
        $update_image_folder = 'uploaded_thumbnail/'.$update_image;
     
        if(!empty($update_image)){
           if($update_image_size > 5000000){
              $message[] = 'image is too large';
           }else{
              $image_update_query = mysqli_query($conn, "UPDATE `video` SET video_pic = '$update_image' WHERE video_id = '$video_id'") or die('query failed');
              if($image_update_query){
                 move_uploaded_file($update_image_tmp_name, $update_image_folder);
              }
              $message[] = 'Thumbnail updated succssfully!';
           }
        }
     
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>WDStudio</title>
    <link rel="stylesheet" href="/WDTube/css/edit_video_form.css">
    <script src="/WDTube/js/edit_video_form.js" defer></script>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <style>
        .file-upload {
        width: 320px;
        }
        
        .file-upload-btn {
            width: 100%;
            margin: 0;
            color: #fff;
            background: #1FB264;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #15824B;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }
        
        .file-upload-btn:hover {
            background: #1AA059;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }
        
        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }
        
        .file-upload-content {
            display: none;
            text-align: center;
        }
        
        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }
        
        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #1FB264;
            position: relative;
        }

        .image-dropping,
        .image-upload-wrap:hover {
        background-color: #1FB264;
        border: 4px dashed #ffffff;
        }

        .image-title-wrap {
        padding: 0 15px 15px 15px;
        color: #222;
        }

        .drag-text {
        text-align: center;
        }

        .drag-text h3 {
        font-weight: 100;
        text-transform: uppercase;
        color: #15824B;
        padding: 60px 0;
        }

        .file-upload-image {
        max-height: 200px;
        max-width: 200px;
        margin: auto;
        padding: 20px;
        }

        .remove-image {
        width: 200px;
        margin: 0;
        color: #fff;
        background: #cd4535;
        border: none;
        padding: 10px;
        border-radius: 4px;
        border-bottom: 4px solid #b02818;
        transition: all .2s ease;
        outline: none;
        text-transform: uppercase;
        font-weight: 700;
        }

        .remove-image:hover {
        background: #c13b2a;
        color: #ffffff;
        transition: all .2s ease;
        cursor: pointer;
        }

        .remove-image:active {
        border: 0;
        transition: all .2s ease;
        }
    </style>

<body>
<header class="header">
        <div class="menu">
            <div class="nav">
                <button class="menu-icon-btn" data-menu-icon-btn onclick="javascript: sideBar_cont();">
                    <i class='bx bx-menu' id="btn"></i> 
                </button>
                <a href="/WDTube/php/your-video.php">
                    <img src="\WDTube\img\WDTUBE.png" alt="WDTUBE-icon">
                    <span class="logo-name">WDStudio</span>
                </a>
                <div class="search">
                    <input type="text" placeholder="Search">
                    <i class='bx bx-search'></i>
                </div>
                <div class="icon">
                    <div class="icon-button">
                        <i class='bx bx-video-plus'><h1>CREATE</h1></i>
                    </div>
                    <div class="user-profile">
                    <button class="link">
                            <div class="profile">
                                <?php
                                    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id = '$user_id'") or die('query failed');
                                    if(mysqli_num_rows($select) > 0){
                                        $fetch = mysqli_fetch_assoc($select);
                                    }
                                    if($fetch['image'] == ''){
                                        echo '<img src="images/default-avatar.png">';
                                    }else{
                                        echo '<img src="uploaded_profile/'.$fetch['image'].'">';
                                    }
                                ?>
                            </div>
                        </button>
                        <div class="dropdown-menu">
                            <form action="/WDTube/php/user-profile.php" method="POST">
                                <input type="text" name="userid" class="hidden" value="<?php echo $user_id?>">
                                <input type="submit" name="" id="" value="Your channel">
                            </form>
                            <a href="/WDTube/php/your-video.php" class="link">WDTube Studio</a>
                            <a href="/WDTube/index.php" class="link">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <aside class="sidebar" data-sidebar>
            <div class="top-sidebar">
                <a href="\WDTube\php\view.php?video_code=<?php echo $edit_select_Result['video_code'];?>" class="video_thumbnail">
                    <?php
                        echo '<img src="uploaded_thumbnail/'.$edit_select_Result['video_pic'].'">';
                    ?>
                </a>
                <div class="hidden-sidebar your-channel">Your video</div>
                <div class="hidden-sidebar channel-name">
                    <?php
                        echo '<h2>'.$edit_select_Result['video_name'].'</h2>';
                    ?>
                </div>
            </div>
            <div class="middle-sidebar">
                <ul class="sidebar-list">
                    <li class="sidebar-list-item">
                        <a href="\WDTube\php\content.php" class="sidebar-link">
                            <svg viewBox="0 0 24 24" class="sidebar-icon" preserveAspectRatio="xMidYMid meet" focusable="false"><g><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8 12.5v-9l6 4.5-6 4.5z"></path></g></svg>
                            <div class="hidden-sidebar">Content</div>
                        </a>
                    </li>
                    <li class="sidebar-list-item active">
                        <a href="" class="sidebar-link">
                            <svg viewBox="0 0 24 24" class="sidebar-icon active" preserveAspectRatio="xMidYMid meet" focusable="false"><path d="m16 2.012 3 3L16.713 7.3l-3-3zM4 14v3h3l8.299-8.287-3-3zm0 6h16v2H4z"></path></svg>
                            <div class="hidden-sidebar">Details</div>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="content">
            <div class="headcontent">
                <div class="headcontent_text ">Video details</div>
            </div>
            <div class="update" style="display: flex">
                <div class="update_form" style="width: 800px; display: inline-block;">
                    <form name="frmUser" method="post" action="edit_update_delete.php" style="width: 800px">
                        <input type="hidden" name="video_id" value="<?php echo $edit_select_Result['video_id']; ?>">
                        Title (required) : <br>
                        <input type="text" name="video_name" class="video_n" style="margin-top: 10px; margin-bottom: 10px; width: 725px;" value="<?php echo $edit_select_Result['video_name']; ?>">
                        <br>

                        <?php
                        $category = "SELECT * FROM category";
                        $categoryQuery = mysqli_query($conn,$category);
                        $categoryResult = mysqli_fetch_assoc($categoryQuery);
                        
                        
                        ?>
                        
                        Cantegory : <br>
                        <div class="custom-select" style="width:300px;">
                            <select name="category_name">
                                <option value="<?php echo $categoryResult['category_id']?>"><?php echo $categoryResult['category_name']?></option>
                                <option value="<?php echo $categoryResult['category_id']?>">Music</option>
                                <?php 
                                    while($categoryResult = mysqli_fetch_assoc($categoryQuery))
                                    {
                                ?>
                                <option value="<?php echo $categoryResult['category_id']?>"><?php echo $categoryResult['category_name'];?></option>
                                <?php 
                                    }
                                ?>
                            </select> 
                        </div>
                
                        Description : <br>
                        <textarea name="video_description" class="area_description" style="margin-top: 10px; margin-bottom: 10px; width: 725px;" ><?php echo $edit_select_Result['video_description']; ?></textarea><br>
                        <button id="myBtn" name="submit" class="submit_button">Submit</button>
                        <input type="submit" name="delete" value="Delete" class="delete_button">
                    </form>  
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="update_thumbnail" style="width: 500px;">
                        <?php
                            if($edit_select_Result['video_pic'] == ''){
                                echo '<img src="images/default-thumbail.jpg" style="width: 320px;">';
                            }else{
                                echo '<img src="uploaded_thumbnail/'.$edit_select_Result['video_pic'].'" style="width: 320px;"> ';
                            }
                            if(isset($message)){
                                foreach($message as $message){
                                echo '<div class="message" style="width: 320px;">'.$message.'</div>';
                                }
                            }
                        ?>
                        <div class="update_thumbnail_text" style="color: #fff; margin-top: 10px;">
                            Thumbnail :
                            <div class="file-upload" style="margin-top: 10px;">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="thumbnail"/>
                                    <div class="drag-text">
                                    <h3>Drag and drop a file or select add Image</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                    </div>
                                </div>
                                <div class="sub"><input type="submit" value="UPDATE" name="update_thumbnail" class="btn"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>

</html>