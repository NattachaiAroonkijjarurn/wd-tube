<?php
    include 'server.php';
    session_start();
    $user_id = $_SESSION['userid'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <title>WDTube</title>
        <link rel="stylesheet" href="/WDTube/css/explore.css">
        <script src="/WdTube/js/main.js" defer></script>
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
                            <a href="\WDTube\php\home.php" class="sidebar-link">
                                <i class='bx bxs-home'></i>
                                <div class="hidden-sidebar">Home</div>
                            </a>
                        </li>
                        <li class="sidebar-list-item active">
                            <a href="\WDTube\php\explore.php" class="sidebar-link">
                                <i class='bx bxs-compass'></i>
                                <div class="hidden-sidebar">Explore</div>
                            </a>
                        </li>
                        <li class="sidebar-list-item active">
                            <a href="\WDTube\php\library.php" class="sidebar-link">
                                <i class='bx bxs-videos'></i>
                                <div class="hidden-sidebar">Library</div>
                            </a>
                        </li>
                        <li class="sidebar-list-item active">
                            <a href="\WDTube\php\history.php" class="sidebar-link">
                                <div class="hidden-sidebar">
                                    <i class='bx bx-history'></i>
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
                                    <i class='bx bxs-time-five'></i>
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
                <ul class="category">
                    <li>
                        <a style="text-decoration: none;" href="/WDTube/php/trending/trending_present.php">
                            <div class="box-of-category">
                                <img src="/WDTube/img/trending_color_64.png" style="width:50px;height:50px; margin-left: 5px; margin-top: 5px;"><br>
                                <div class="category-text">Trending</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a style="text-decoration: none;" href="/WDTube/php/music/music.php">
                            <div class="box-of-category">
                                <img src="/WDTube/img/music_color_64.png" style="width:50px;height:50px; margin-left: 5px; margin-top: 5px;"><br>
                                <div class="category-text">Music</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a style="text-decoration: none;" href="/WDTube/php/gaming.php">
                            <div class="box-of-category">
                                <img src="/WDTube/img/gaming_color_64.png" style="width:50px;height:50px; margin-left: 5px; margin-top: 5px;"><br>
                                <div class="category-text">Gaming</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a style="text-decoration: none;" href="/WDTube/php/news/news.php">
                            <div class="box-of-category">
                                <img src="/WDTube/img/news_color_64.png" style="width:50px;height:50px; margin-left: 5px; margin-top: 5px;"><br>
                                <div class="category-text">News</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a style="text-decoration: none;" href="/WDTube/php/sports.php">
                            <div class="box-of-category">
                                <img src="/WDTube/img/sports_color_64.png" style="width:50px;height:50px; margin-left: 5px; margin-top: 5px;"><br>
                                <div class="category-text">Sports</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="explorer-text">Trending videos</div>
                <div class="video-container">
                    <?php

                    $query = 'SELECT * FROM video ORDER BY count_view DESC,video_name';

                    $result = mysqli_query($conn, $query);

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