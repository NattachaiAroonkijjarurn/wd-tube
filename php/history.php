<?php

include 'server.php';
session_start();
$user_id = $_SESSION['userid'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

if(isset($_POST['delete-btn'])){
    $vid = $_POST['vid'];
    $hdelete = mysqli_query($conn, "DELETE FROM history WHERE video_id = $vid");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <title>WDTube</title>
  <link rel="stylesheet" href="/WDTube/css/history.css">
  <script src="/WDTube/js/main.js" defer></script>
</head>
<body>
  <header class="header">
    <div class="menu">
        <div class="nav">
            <button class="menu-icon-btn" data-menu-icon-btn onclick="javascript: sideBar_cont();">
                <i class='bx bx-menu' id="btn"></i> 
            </button>
            <a href="/WDTube/php/home.php">
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
        <div class="video-box">
            <div class="stitle"><a href="\WDTube\php\history.php">Watch history</a></div>
            <div class="video-container">
                <?php
                    $result = mysqli_query($conn, "SELECT * FROM history WHERE user_id='$user_id' ORDER BY history_date DESC");
                    while ($record = mysqli_fetch_assoc($result))
                    {
                        $vid = $record['video_id'];
                        $hresult = mysqli_query($conn, "SELECT * FROM video WHERE video_id='$vid'");
                        $hrecord = mysqli_fetch_assoc($hresult);
                        $uid = $hrecord['user_id'];
                        $uresult = mysqli_query($conn, "SELECT * FROM user WHERE user_id='$uid'");
                        $urecord = mysqli_fetch_assoc($uresult);
                ?>
                    <form action="" method="POST">
                        <div class="video">
                            <div class="thumbnail">
                                <?php
                                    echo '<a href="\WDTube\php\view.php?video_code='.$hrecord['video_code'].'"><img src="uploaded_thumbnail/'.$hrecord['video_pic'].'"></a>';
                                ?>
                            </div>
                            <div class="info">
                                <div class="title">
                                    <?php
                                        echo '<a href="\WDTube\php\view.php?video_code='.$hrecord['video_code'].'"><h2>'.$hrecord['video_name'].'</h2></a>';
                                    ?>
                                </div>
                                <div class="name-count">
                                    <?php
                                        echo '<a href="\WDTube\php\view.php?video_code='.$hrecord['video_code'].'"><h3>'.$urecord['username'].' &bull; '.$hrecord['count_view'].' views</h3></a>';
                                    ?>
                                </div>
                                <div class="description">
                                    <?php
                                        echo '<a href="\WDTube\php\view.php?video_code='.$hrecord['video_code'].'"><h3>'.$hrecord['video_description'].'</h3></a>';
                                    ?>
                                </div>
                            </div>
                            <input type="text" name="vid" class="hidden" value="<?=$vid?>">
                            <input type="submit" name="delete-btn" class="delete-btn" value="x">
                        </div>
                    </form>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

</div>
</body>
</html>