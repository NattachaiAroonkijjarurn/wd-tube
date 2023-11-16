<?php 

    include 'server.php';
    session_start();
    $vchannel = $_POST['userid'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <title>WDTube</title>
  <link rel="stylesheet" href="/WDTube/css/user-profilenologin.css">
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
                <form action="/WDTube/php/search.php" method="POST">
                    <input type="text" name="search" class="search-bar" placeholder="Search">
                    <button type="submit" name="submit-search" class="search-btn"><i class='bx bx-search'></i></button>
                </form>
            </div>
            <div class="icon">
                <div class="icon-cam">
                    <a href="\WDTube\php\upload.php"><i class='bx bx-video-plus' ></i></a>
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
                    <a href="/WDTube/php/home.php" class="sidebar-link">
                        <i class='bx bxs-home' ></i>
                        <div class="hidden-sidebar">Home</div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\explore.php" class="sidebar-link">
                        <i class='bx bxs-compass' ></i>
                        <div class="hidden-sidebar">Explore</div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\library.php" class="sidebar-link">
                        <i class='bx bxs-videos' ></i>
                        <div class="hidden-sidebar">Library</div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\history.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bx-history' ></i>
                            <div class="hidden-sidebars">History</div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="/WDTube/php/your-video.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bxs-caret-right-square'></i>
                            <div class="hidden-sidebars">Your Video</div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\watch_later.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bxs-time-five' ></i>
                            <div class="hidden-sidebars">Watch later</div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="\WDTube\php\playlist.php" class="sidebar-link">
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
        <div class="box1">
            <div class="head-content">
                <div class="profile-box">
                    <div class="profile">
                        <?php
                            $select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id = '$vchannel'") or die('query failed');
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
                </div>
                <div class="detail">
                    <h1><?php echo $fetch['username']; ?></h1>
                </div>
            </div>
        </div>
        <div class="box2">
            <div class="middle-content">
                <form action="\WDTube\php\user-profilenologin.php" method="POST">
                <input type="text" class="hidden" name="userid" value="<?=$vchannel?>">
                <input type="submit" class="mcoption active" value="HOME">
                </form>
            </div>
            <div class="middle-content">
                <form action="\WDTube\php\user-profilenologin-video.php" method="POST">
                <input type="text" class="hidden" name="userid" value="<?=$vchannel?>">
                <input type="submit" class="mcoption" value="VIDEOS">
                </form>
            </div>
            <div class="middle-content">
                <form action="\WDTube\php\user-profilenologin-playlist.php" method="POST">
                <input type="text" class="hidden" name="userid" value="<?=$vchannel?>">
                <input type="submit" class="mcoption" value="PLAYLISTS">
                </form>
            </div>
        </div>
        <div class="main-content">
            <div class="video-box">
                <div class="title"><a href="\WDTube\php\user-profile-video.php">Video</a></div>
                <div class="video-container">
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM video WHERE user_id = '$vchannel'");
                        if (empty($result))
                        {
                            ?>
                                <div class="btext"><h3>No video...</h3></div>
                            <?php
                        }else{
                        while ($record = mysqli_fetch_assoc($result))
                        {
                    ?>
                    <div class="video">
                        <div class="thumbnail">
                            <?php
                                echo '<a href="\WDTube\php\view.php?video_code='.$record['video_code'].'"><img src="uploaded_thumbnail/'.$record['video_pic'].'"></a>';
                            ?>
                        </div>
                        <div class="contents">
                            <div class="info">
                                <div class="title">
                                    <?php
                                        echo '<a href="\WDTube\php\view.php?video_code='.$record['video_code'].'"><h2>'.$record['video_name'].'</h2></a>';
                                    ?>
                                </div>
                                <div class="count">
                                    <?php
                                        echo '<a href="\WDTube\php\view.php?video_code='.$record['video_code'].'"><h3>'.$record['count_view'].' views</h3></a>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                        }
                    ?>
                </div>
            </div>
            <div class="playlist-box">
                <div class="title"><a href="/WDTube/php/playlist.php">Playlist</a></div>
                <div class="video-container">
                    <?php
                        $presult = mysqli_query($conn, "SELECT * FROM create_playlist WHERE user_id='$vchannel'");
                        $precord = mysqli_fetch_assoc($presult);
                        if (empty($precord))
                        {
                            ?>
                                <div class="btext"><h3>No playlist...</h3></div>
                            <?php
                        }else{
                        while (!empty($precord))
                        {
                            $puid = $precord['user_id'];
                            $pselect = mysqli_query($conn, "SELECT username FROM user WHERE user_id = '$puid'");
                            $pfetch = mysqli_fetch_assoc($pselect);
                    ?>
                    <div class="video">
                        <div class="thumbnail">
                            <img src="uploaded_thumbnail/my-best-casette-playlist-5k-za.jpg">
                        </div>
                        <div class="contents">
                            <div class="info">
                                <div class="title">
                                    <?php
                                        echo '<h2>'.$precord['playlist_name'].'</h2>';
                                    ?>
                                </div>
                                <div class="channel-name">
                                    <form action="/WDTube/php/user-profile.php" method="POST">
                                        <input type="text" name="username" class="hidden" value="<?php echo $puid?>">
                                        <?php
                                            echo '<input type="submit" name="" id="h3" value="'.$pfetch['username'].'">'
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $precord = mysqli_fetch_assoc($presult);
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    
</div>
</body>
</html>


