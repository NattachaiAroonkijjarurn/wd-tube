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

date_default_timezone_set('Asia/Bangkok');
$date_now = date('Y-m-d H:i:s');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <title>WDTube</title>
  <link rel="stylesheet" href="/WDTube/css/home.css">
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
                            $select = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$user_id'") or die('query failed');
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
        <div class="tab">
            <div>
                <a href=""><div>All</div></a>
                <a href="/WDTube/php/music/music.php"><div>Music</div></a>
                <a href="/WDTube/php/gaming.php"><div>Gaming</div></a> 
                <a href="/WDTube/php/news/news.php"><div>New</div></a>
                <a href="/WDTube/php/sports.php"><div>Sports</div></a>
            </div>
        </div>
        <div class="video-container">
        <?php

        $query = 'SELECT * FROM video ORDER BY video_name';

        $result = mysqli_query($conn, $query);
        if (!$result)
        {
            echo 'Error Message: ' . mysqli_error($conn) . '<br>';
            exit;
        }

        while ($record = mysqli_fetch_assoc($result))
        {
            $vid =  $record['video_id'];
            $vc = $record['video_code'];
        ?> 
                <div class="video">
                    <div class="thumbnail">
                        <?php
                        echo '<a href="\WDTube\php\view.php?video_code='.$record['video_code'].'"><img src="uploaded_thumbnail/'.$record['video_pic'].'"></a>';
                        /*
                        playvideo
                        echo '<iframe width="365" height="205" src="https://www.youtube.com/embed/'.$record['video_code'].'?modestbranding=1" 
                            rameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>';
                        */
                        ?>
                    </div>
                    <div class="contents">
                        <div class="channel-icon">
                            <?php
                            $recordch = $record['user_id'];
                            $recordc = $record['video_id'];
                            $selectch = mysqli_query($conn, "SELECT username, image FROM `user` WHERE user_id = '$recordch'");
                            $fetchch = mysqli_fetch_assoc($selectch);
                            if($fetchch['image'] == ''){
                                echo '<img src="images/default-avatar.png">';
                            }else{
                                echo '<img src="uploaded_profile/'.$fetchch['image'].'">';
                            }
                            ?>
                        </div>
                        <div class="info">
                            <div class="title">
                                <?php
                                    echo '<a href="\WDTube\php\view.php?video_code='.$record['video_code'].'"><h2>'.$record['video_name'].'</h2></a>';
                                ?>
                            </div>
                            <div class="channel-name">
                                <form action="/WDTube/php/user-profile.php" method="POST">
                                    <input type="text" name="userid" class="hidden" value="<?php echo $recordch?>">
                                    <?php
                                        echo '<input type="submit" name="" id="h3" value="'.$fetchch['username'].'">'
                                    ?>
                                </form>
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
        ?>   
        </div>
    </div>

</div>
</body>
</html>