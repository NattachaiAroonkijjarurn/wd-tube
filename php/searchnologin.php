<?php

include 'server.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <title>WDTube</title>
  <link rel="stylesheet" href="/WDTube/css/searchnologin.css">
  <script src="/WDTube/js/main.js" defer></script>
</head>
<body>
  <header class="header">
    <div class="menu">
        <div class="nav">
            <button class="menu-icon-btn" data-menu-icon-btn onclick="javascript: sideBar_cont();">
                <i class='bx bx-menu' id="btn"></i> 
            </button>
            <a href="/WDTube/index.php">
                <img src="\WDTube\img\WDTUBE.png" alt="WDTUBE-icon">
                <span class="logo-name">WDTube</span>
            </a>
            <div class="search">
                <form action="/WDTube/php/searchnologin.php" method="POST">
                    <input type="text" name="search" class="search-bar" placeholder="Search">
                    <button type="submit" name="submit-search" class="search-btn"><i class='bx bx-search'></i></button>
                </form>
            </div>
            <div class="icon">
                <div class="icon-cam">
                    <a href="\WDTube\php\login.php"><i class='bx bx-video-plus' ></i></a>
                </div>
                <div class="dropdown">

                </div>
                <div class="user-profile">
                    <a href="/WDTube/php/login.php"><div class="profile"><p>SING IN</p></div></a>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <aside class="sidebar" data-sidebar id="sideBar">
        <div class="midsidebar">
            <ul class="sidebar-list">
                <li class="sidebar-list-item active">
                    <a href="index.php" class="sidebar-link">
                        <i class='bx bxs-home' ></i>
                        <div class="hidden-sidebar">Home</div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\login.php" class="sidebar-link">
                        <i class='bx bxs-compass' ></i>
                        <div class="hidden-sidebar">Explore</div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\login.php" class="sidebar-link">
                        <i class='bx bxs-videos' ></i>
                        <div class="hidden-sidebar">Library</div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\login.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bx-history' ></i>
                            <div class="hidden-sidebars">History</div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\login.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bxs-caret-right-square'></i>
                            <div class="hidden-sidebars">Your Video</div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\login.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bxs-time-five' ></i>
                            <div class="hidden-sidebars">Watch later</div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\login.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bx-right-indent'></i>
                            <div class="hidden-sidebars">Playlist</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <div class="content">
        <div class="video-container">
        <?php
        if(isset($_POST['submit-search'])) {
            $search = mysqli_real_escape_string($conn, $_POST['search']);

            $query = "SELECT * FROM video WHERE video_name LIKE '%$search%'";
            $result = mysqli_query($conn, $query);
            
            $uquery = "SELECT * FROM user WHERE username LIKE '%$search%'";
            $uresult = mysqli_query($conn, $uquery);

            if (mysqli_num_rows($result) != 0) {

            while ($urecord = mysqli_fetch_assoc($uresult))
            {
            ?>
                <div class="channel">
                    <div class="ch-profile">
                        <?php
                            $recordch = $urecord['user_id'];
                            $selectch = mysqli_query($conn, "SELECT username, image FROM user WHERE user_id = '$recordch'");
                            $fetchch = mysqli_fetch_assoc($selectch);
                            if($fetchch['image'] == ''){
                                echo '<img src="images/default-avatar.png">';
                            }else{
                                echo '<img src="/WDTube/php/uploaded_profile/'.$fetchch['image'].'">';
                            }
                        ?>
                    </div>
                    <form action="/WDTube/php/user-profilenologin.php" method="POST">
                    <div class="ch-name">
                        <input type="text" name="userid" class="hidden" value="<?=$recordch?>">
                        <?php 
                            echo '<input type="submit" class="subch" value="'.$fetchch['username'].'">';
                        ?>
                    </div>
                    </form>
                </div>
            <?php
            }

            while ($record = mysqli_fetch_assoc($result))
            {
            ?>
            <div class="video">
                <div class="thumbnail">
                    <?php echo '<a href="\WDTube\php\viewnologin.php?video_code='.$record['video_code'].'"><img src="/WDTube/php/uploaded_thumbnail/'.$record['video_pic'].'"></a>';?>
                </div>
                <div class="info">
                    <div class="title">
                        <?php
                            echo '<a href="\WDTube\php\viewnologin.php?video_code='.$record['video_code'].'"><h2>'.$record['video_name'].'</h2></a>';
                        ?>
                    </div>
                    <div class="count">
                        <?php
                            echo '<a href="\WDTube\php\viewnologin.php?video_code='.$record['video_code'].'"><h3>'.$record['count_view'].' views</h3></a>';
                        ?>
                    </div>
                    <div class="channel-icon">
                        <?php
                        $recordch = $record['user_id'];
                        $selectch = mysqli_query($conn, "SELECT username, image FROM user WHERE user_id = '$recordch'");
                        $fetchch = mysqli_fetch_assoc($selectch);
                        if($fetchch['image'] == ''){
                            echo '<img src="images/default-avatar.png">';
                        }else{
                            ?>
                            <form action="/WDTube/php/user-profilenologin.php" class="form" method="POST">
                                <input type="text" name="userid" class="hidden" value="<?=$recordch?>">
                                <?php 
                                    echo '<input type="submit" id="subchimg" value="'.$fetchch['username'].'">';
                                ?>
                            </form>
                            <?php
                            echo '<img src="/WDTube/php/uploaded_profile/'.$fetchch['image'].'">';
                        }
                        ?>
                    </div>
                    <form action="/WDTube/php/user-profilenologin.php" class="form" method="POST">
                    <div class="channel-name">
                        <input type="text" name="userid" class="hidden" value="<?=$recordch?>">
                        <?php 
                            echo '<input type="submit" class="subch" value="'.$fetchch['username'].'">';
                        ?>
                    </div>
                    </form>
                    <div class="description">
                        <?php
                            echo '<a href="\WDTube\php\viewnologin.php?video_code='.$record['video_code'].'"><p>'.$record['video_description'].'</p></a>';
                        ?>
                    </div>
                </div>
            </div>
            <?php
            }
            }else {
                echo '<div class="notfound"><h6>No results found...</h6></div>';
            }
        }
        ?>
        </div>
    </div>
    
</div>
</body>
</html>