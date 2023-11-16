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
    <link rel="stylesheet" href="/WDTube/css/music/music_about.css">
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
                                    echo '<img src="/WDTube/php/images/default-avatar.png">';
                                }else{
                                    echo '<img src="/WDTube/php/uploaded_profile/'.$fetch['image'].'">';
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
            <img src="/WDTube/img/bg_music.png" style="width:100%;">
            <div class="channel_head">
                <div class="channel_head_next">
                    <img src='/WDTube/img/music_color_64.png' style="margin-top: 15px; margin-left: 100px;">
                    <div class="channel_head_next_text">Music</div>
                </div>
                <ul class=" channel_head_text ">
                    <li>
                        <a href="/WDTube/php/music/music.php" class="channel_head_bar">
                            <div class="channel_head_bar">Home</div>
                        </a>
                    </li>
                    <li>
                        <a href="/WDTube/php/music/music_about.php" class="channel_head_bar">
                            <div class="channel_head_bar">
                                <div class="channel_head_bar_text_present">About</div>
                            </div>
                            <div class="channel_line_bar"></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box">
                <div class="box1">
                    <div class="title">
                        <h5>Description</h5>
                        <h6>
                            Visit the YouTube Music Channel to find today’s top talent, featured artists, and playlists. Subscribe to see the latest in the music world. <br>
                            This channel was generated automatically by YouTube's video discovery system.
                        </h6>
                    </div>
                </div>
                <div class="box2">
                    <div class="title"><h5>Stats</h5></div>
                    <div class="text"><h6>Joined Sep 24, 2013</h6></div>
                </div>
            </div>
        </div>
</body>

</html>