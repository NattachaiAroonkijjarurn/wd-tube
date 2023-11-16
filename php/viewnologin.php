<?php
    include 'server.php';
    session_start();
    $video_code = $_GET['video_code'];
    $query = "SELECT video_id,user_id,video_pic,video_name,video_description,video_code,date,category_id,count_view
            FROM video
            WHERE video_code = '$video_code'";

    $result = mysqli_query($conn, $query);
    $record = mysqli_fetch_assoc($result);

    $vid = $record['video_id'];
    
    $cid = $record['category_id'];
    $queryca = mysqli_query($conn, "SELECT * FROM category WHERE category_id = '$cid'");
    $recordca = mysqli_fetch_assoc($queryca);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <title>WDTube</title>
  <link rel="stylesheet" href="\WDTube\css\viewnologin.css">
  <script src="/WdTube/js/main.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="/WdTube/js/popup.js" defer></script>
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
                    <a href="/WDTube/php/login.php"><i class='bx bx-video-plus' ></i></a>
                </div>
                <div class="dropdown">
                        <button class="link"><i class='bx bx-dots-vertical-rounded'></i></button>
                        <div class="dropdown-menu">
                            <div class="dropdown-link">
                                <a href="" class="link">Appearnce</a>
                            </div>
                        </div>
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
                    <a href="/WDTube/index.php" class="sidebar-link">
                        <i class='bx bxs-home' ></i>
                        <div class="hidden-sidebar">Home</div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="/WDTube/php/login.php" class="sidebar-link">
                        <i class='bx bxs-compass' ></i>
                        <div class="hidden-sidebar">Explore</div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="/WDTube/php/login.php" class="sidebar-link">
                        <i class='bx bxs-videos' ></i>
                        <div class="hidden-sidebar">Library</div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="/WDTube/php/login.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bx-history' ></i>
                            <div class="hidden-sidebars">History</div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="/WDTube/php/login.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bxs-caret-right-square'></i>
                            <div class="hidden-sidebars">Your Video</div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="/WDTube/php/login.php" class="sidebar-link">
                        <div class="hidden-sidebar">
                            <i class='bx bxs-time-five' ></i>
                            <div class="hidden-sidebars">Watch later</div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-list-item active">
                    <a href="/WDTube/php/login.php" class="sidebar-link">
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
        <div class="row">
            <div class="playvideo">
                <?php
                    echo '<iframe width="1100" height="618" src="https://www.youtube.com/embed/'.$video_code.'?modestbranding=1" 
                        rameborder="0" autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>';
                ?>
                <div class="tags">
                    <a href="\WDTube\php\explore.php"><?php echo'#'; echo $recordca['category_name']?></a>
                </div>
                <?php
                echo '<h3>'.$record['video_name'].'</h3>';
                ?>
                <div class="info">
                    <?php
                        $m = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                        $vdate = explode("-",explode(" ",$record['date'])[0]);
                        echo '<p>'.$record['count_view'].' views &bull; '.$m[(int)$vdate[1]].' '.(int)$vdate[2].', '.$vdate[0].' </p>';
                    ?>
                    <div class="box">
                        <div class="playlist">
                            <a href="#" id="button"><i class='bx bx-list-plus'><div class="plays">Save</div></i></a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="plublisher">
                    <?php
                    $recordch = $record['user_id'];
                    $selectch = mysqli_query($conn, "SELECT username, image FROM `user` WHERE user_id = '$recordch'");
                    $fetchch = mysqli_fetch_assoc($selectch);
                    ?>
                        <input type="text" name="userid" class="hidden" value="<?php echo $recordch?>">
                    <?php
                    if($fetchch['image'] == ''){
                        echo '<img src="images/default-avatar.png">';
                    }else{
                        echo '<img src="/WDTube/php/uploaded_profile/'.$fetchch['image'].'">';
                    }
                    ?>
                    <div>
                        <form action="/WDTube/php/user-profilenologin.php" method="POST">
                            <input type="text" name="userid" class="hidden" value="<?php echo $recordch?>">
                        <?php
                            echo '<input type="submit" name="" id="" value="'.$fetchch['username'].'">'
                        ?>
                        </form>
                    </div>
                </div>
                <div class="description">
                    <?php
                    echo '<p>'.$record['video_description'].'</p>';
                    ?>
                    <hr>
                </div>   
                <!-----------------------Comment---------------------------->
                <div class="comment">
                    <div class="enterbox">
                        <div class="profile">
                            <img src="images/default-avatar.png">;
                        </div>
                        <div class="textbox">
                            <a href="\WDTube\php\login.php"><textarea name="" id="autoresizing" placeholder ="Write Comment"></textarea></a>
                            <script type="text/javascript">
                            $('#autoresizing').on('input', function () {
                                this.style.height = 'auto';
                                
                                this.style.height = 
                                        (this.scrollHeight) + 'px';
                            });
                            </script>
                        </div>
                    </div>
                    <?php
                    $comresule = mysqli_query($conn, "SELECT * FROM comment WHERE video_id='$vid'");
                    while($comrecord = mysqli_fetch_assoc($comresule))
                    {
                        $id = $comrecord['video_id'];
                        $v = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM video WHERE video_id='$id'"));
                        $uid = $comrecord['user_id'];
                        $u = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE user_id='$uid'"));
                    ?>
                        <div class="showbox">
                            <div class="showcom">
                                <div class="chprofile">
                                <?php
                                    if($fetchch['image'] == ''){
                                        echo '<img src="images/default-avatar.png">';
                                    }else{
                                        echo '<img src="/WDTube/php/uploaded_profile/'.$u['image'].'">';
                                    }
                                ?>
                                </div>
                                <div class="scbox">
                                    <div class="name-date">
                                    <form action="/WDTube/php/user-profilenologin.php" method="POST">
                                        <input type="text" name="userid" class="hidden" value="<?php echo $u['user_id'];?>">
                                        <div class="nd">
                                        <?php
                                            echo '<input type="submit" name="" id="" value="'.$u['username'].'">','<h5>'.$comrecord['comment_date'].'</h5>';
                                        ?>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="comtext">
                                        <?php
                                            echo $comrecord['comment_text'];
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
    
            <div class="rightsidebar">
                <?php
                $squery = 'SELECT video_id,user_id,video_pic,video_name,video_description,video_code,date,category_id,count_view
                FROM video
                ORDER BY video_id';

                $sresult = mysqli_query($conn, $squery);

                if (!$sresult)
                {
                    echo 'Error Message: ' . mysqli_error($conn) . '<br>';
                    exit;
                }
                while($row = mysqli_fetch_array($sresult)) {
                ?>
                <div class="sidevideo">
                    <?php echo '<a href="\WDTube\php\viewnologin.php?video_code='.$row['video_code'].'"><img src="uploaded_thumbnail/'.$row['video_pic'].'"></a>';?>
                    <div class="vid">
                        <div class="title">
                            <?php
                                echo '<a href="\WDTube\php\viewnologin.php?video_code='.$row['video_code'].'"><h2>'.$row['video_name'].'</h2></a>';
                            ?>
                        </div>
                        <div class="channel-name">
                            <?php
                                $recordchs = $row['user_id'];
                                $selectchs = mysqli_query($conn, "SELECT username, image FROM `user` WHERE user_id = '$recordchs'");
                                $fetchchs = mysqli_fetch_assoc($selectchs);
                                echo '<a href="\WDTube\php\viewnologin.php?video_code='.$row['video_code'].'"><h3>'.$fetchchs['username'].'</h3></a>';
                            ?>
                        </div>
                        <div class="count">
                            <?php
                                echo '<a href="\WDTube\php\viewnologin.php?video_code='.$row['video_code'].'"><h3>'.$row['count_view'].' views &bull; </a>';
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-----------------------POP UP---------------------------->
    <div class="bg-modal">
        <div class="modal-contents">
        <div class="poptitle"><label>Sign in to add this video to a playlist.</label></div>
            <div class="close">+</div>
            <a href="/WDTube/php/login.php"><div class="profile"><p>SING IN</p></div></a>
        </div>
    </div>
</div>
</body>
</html>

<?php

if(isset($_POST["listsubmit"])) {
    
    $listcheck = $_POST['listcheck'];
    foreach($listcheck as $item)
    {
        $listquery = "INSERT INTO watchlater (user_id, video_id) VALUES ('$user_id', '$item')";
        $query_run = mysqli_query($conn, $listquery);
    }
    if($query_run)
    {
        $_SESSION['status'] = "Inserted Successfully";
    }
    else
    {
        $_SESSION['status'] = "Not Inserted";
    }
}

?>