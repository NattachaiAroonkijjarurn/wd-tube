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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <title>WDTube</title>
  <link rel="stylesheet" href="/WDTube/css/library.css">
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
        <div class="box">
            <div class="history-box">
                <div class="title"><a href="/WDTube/php/history.php">History</a></div>
                <div class="video-container">
                    <?php
                        $hresult = mysqli_query($conn, "SELECT * FROM video INNER JOIN history ON video.video_id=history.video_id WHERE history.user_id = '$user_id'");
                        $hrecord = mysqli_fetch_assoc($hresult);
                        if (empty($hrecord))
                        {
                            ?>
                                <div class="btext"><h3>Videos you watch will show up here.</h3>'</div>
                            <?php
                        }else{
                            while (!empty($hrecord))
                            {
                                $huid = $hrecord['user_id'];
                                $hselect = mysqli_query($conn, "SELECT username FROM user WHERE user_id = '$huid'");
                                $hfetch = mysqli_fetch_assoc($hselect);
                        ?>
                        <div class="video">
                            <div class="thumbnail">
                                <?php
                                    echo '<a href="\WDTube\php\view.php?video_code='.$hrecord['video_code'].'"><img src="uploaded_thumbnail/'.$hrecord['video_pic'].'"></a>';
                                ?>
                            </div>
                            <div class="contents">
                                <div class="info">
                                    <div class="title">
                                        <?php
                                            echo '<a href="\WDTube\php\view.php?video_code='.$hrecord['video_code'].'"><h2>'.$hrecord['video_name'].'</h2></a>';
                                        ?>
                                    </div>
                                    <div class="channel-name">
                                        <form action="/WDTube/php/user-profile.php" method="POST">
                                            <input type="text" name="userid" class="hidden" value="<?php echo $huid?>">
                                            <?php
                                                echo '<input type="submit" name="" id="h3" value="'.$hfetch['username'].'">'
                                            ?>
                                        </form>
                                    </div>
                                    <div class="count">
                                        <?php
                                            echo '<a href="\WDTube\php\view.php?video_code='.$hrecord['video_code'].'"><h3>'.$hrecord['count_view'].' views</h3></a>';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $hrecord = mysqli_fetch_assoc($hresult);
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="watchlater-box">
                <div class="title"><a href="/WDTube/php/watch_later.php">Watchlater</a></div>
                <div class="video-container">
                    <?php
                        $wresult = mysqli_query($conn, "SELECT * FROM video INNER JOIN watchlater ON video.video_id=watchlater.video_id WHERE watchlater.user_id = '$user_id'");
                        $wrecord = mysqli_fetch_assoc($wresult);
                        if (empty($wrecord))
                        {
                            ?>
                                <div class="btext"><h3>Save videos to watch later. Your list shows up right here.</h3></div>
                            <?php
                        }else{
                            while (!empty($wrecord))
                            {
                                $wuid = $wrecord['user_id'];
                                $wselect = mysqli_query($conn, "SELECT username FROM user WHERE user_id = '$wuid'");
                                $wfetch = mysqli_fetch_assoc($wselect);
                        ?>
                        <div class="video">
                            <div class="thumbnail">
                                <?php
                                    echo '<a href="\WDTube\php\view.php?video_code='.$wrecord['video_code'].'"><img src="uploaded_thumbnail/'.$wrecord['video_pic'].'"></a>';
                                ?>
                            </div>
                            <div class="contents">
                                <div class="info">
                                    <div class="title">
                                        <?php
                                            echo '<a href="\WDTube\php\view.php?video_code='.$wrecord['video_code'].'"><h2>'.$wrecord['video_name'].'</h2></a>';
                                        ?>
                                    </div>
                                    <div class="channel-name">
                                        <form action="/WDTube/php/user-profile.php" method="POST">
                                            <input type="text" name="userid" class="hidden" value="<?php echo $wuid?>">
                                            <?php
                                                echo '<input type="submit" name="" id="h3" value="'.$wfetch['username'].'">'
                                            ?>
                                        </form>
                                    </div>
                                    <div class="count">
                                        <?php
                                            echo '<a href="\WDTube\php\view.php?video_code='.$wrecord['video_code'].'"><h3>'.$wrecord['count_view'].' views</h3></a>';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $wrecord = mysqli_fetch_assoc($wresult);
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="playlist-box">
                <div class="title"><a href="/WDTube/php/playlist.php">Playlist</a></div>
                <div class="video-container">
                    <?php
                        $presult = mysqli_query($conn, "SELECT * FROM create_playlist WHERE user_id='$user_id'");
                        $precord = mysqli_fetch_assoc($presult);
                        if (empty($precord))
                        {
                            ?>
                                <div class="btext"><h3>Save videos to Playlist. Your list shows up right here.</h3></div>
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
                            <?php
                                $pid = $precord['playlist_id'];
                                $lselects = mysqli_query($conn, "SELECT * FROM video INNER JOIN playlist ON video.video_id = playlist.video_id WHERE playlist.playlist_id='$pid'");
                                $lfetchs = mysqli_fetch_assoc($lselects);
                                if(!is_null($lfetchs))
                                {
                                    echo '<a href="\WDTube\php\playlist_view.php?playlist_id='.$precord['playlist_id'].'&video_code='.$lfetchs['video_code'].'"><img src="uploaded_thumbnail/my-best-casette-playlist-5k-za.jpg"></a>';
                            ?>
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
                                            echo '<input type="submit" name="" id="h3" value="'.$pfetch['username'].'">';
                                }
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