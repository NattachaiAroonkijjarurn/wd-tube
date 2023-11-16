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
  <link rel="stylesheet" href="/WDTube/css/watch_later.css">
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
                                    <input type="text" name="username" class="hidden" value="<?php echo $user_id?>">
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
                    <a href="#" class="sidebar-link">
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
        <div class="contentbox">
            <div class="sidebox">
                <?php
                    $wl = mysqli_query($conn, "SELECT * FROM watchlater WHERE user_id='$user_id'");
                    $swl = mysqli_fetch_assoc($wl);
                    if(is_null($swl))
                    {
                        ?>
                        <div class="topsideboxs">
                            <div class="imgwatchs"><img src="uploaded_thumbnail/no.jpg"></div>
                            <div class="titles"><p>Watch later</p></div>
                        </div>
                        <hr class="hr1">
                        <div class="bottomsidebars">
                            <div class="imgpros">
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
                            <div class="chnames">
                                <form action="/WDTube/php/user-profile.php" method="POST">
                                    <input type="text" name="userid" class="hidden" value="<?php echo $recordch?>">
                                    <?php
                                        echo '<input type="submit" name="" id="" value="'.$fetch['username'].'">'
                                    ?>
                                </form>
                            </div>
                        </div>
                        <?php
                    }else{
                    ?>
                        <div class="topsidebox">
                            <div class="imgwatch">
                                <?php
                                $lselects = mysqli_query($conn, "SELECT * FROM video INNER JOIN watchlater ON video.video_id = watchlater.video_id WHERE watchlater.user_id='$user_id'");
                                $lfetchs = mysqli_fetch_assoc($lselects);
                                echo '<a href="\WDTube\php\view.php?video_code='.$lfetchs['video_code'].'"><img src="uploaded_thumbnail/'.$lfetchs['video_pic'].'"></a>';
                                ?>
                                <?php echo '<a href="\WDTube\php\view.php?video_code='.$lfetchs['video_code'].'"><div class="p"><p>PLAY ALL</p></div></a>';?>
                            </div>
                            <div class="title"><p>Watch later</p></div>
                        </div>
                        <hr class="hr1">
                        <div class="bottomsidebar">
                            <div class="imgpro">
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
                            <div class="chname">
                                <form action="/WDTube/php/user-profile.php" method="POST">
                                    <input type="text" name="userid" class="hidden" value="<?php echo $recordch?>">
                                    <?php
                                        echo '<input type="submit" name="" id="" value="'.$fetch['username'].'">'
                                    ?>
                                </form>
                            </div>
                        </div>
                <?php
                }
                ?>
            </div>

            <div class="sortbox">
                <div class="sort">
                    <div class="sortlogo"><i class='bx bx-menu-alt-left'></i></div>
                    <div class="sortname"><p>SORT</p></div>
                </div>
                <div class="listvideo">
                    <form action="watchlater_delete.php" method="POST">
                        <input type="submit" id="lre" name="listremove" value="Remove">
                            <?php
                            $lselect = mysqli_query($conn, "SELECT * FROM video INNER JOIN watchlater ON video.video_id = watchlater.video_id WHERE watchlater.user_id='$user_id'");

                                while($lfetch = mysqli_fetch_assoc($lselect)) {
                                ?>
                                <div class="sidevideo">
                                    <?php echo '<a href="\WDTube\php\view.php?video_code='.$lfetch['video_code'].'"><img src="uploaded_thumbnail/'.$lfetch['video_pic'].'"></a>';?>
                                    <div class="vid">
                                        <div class="title">
                                            <?php
                                                echo '<a href="\WDTube\php\view.php?video_code='.$lfetch['video_code'].'"><h2>'.$lfetch['video_name'].'</h2></a>';
                                            ?>
                                        </div>
                                        <div class="channel-name">
                                            <?php
                                                $vid = $lfetch['video_id'];
                                                $squery = mysqli_query($conn,"SELECT user_id FROM video WHERE video_id = '$vid'");
                                                $sfetch = mysqli_fetch_assoc($squery);
                                                $recordchs = $sfetch['user_id'];
                                                $selectchs = mysqli_query($conn, "SELECT username FROM `user` WHERE user_id = '$recordchs'");
                                                $fetchchs = mysqli_fetch_assoc($selectchs);
                                                echo '<a href="\WDTube\php\view.php?video_code='.$lfetch['video_code'].'"><h3>'.$fetchchs['username'].'</h3></a>';
                                            ?>
                                        </div>
                                        <div class="edit">
                                            <?php echo '<input type="checkbox" name="listcheck[]" value="'.$lfetch['video_id'].'">' ?>
                                            <label class="text">Remove</label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                            ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>