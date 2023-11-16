<?php
    include 'server.php';
    session_start();
    $user_id = $_SESSION['userid'];
    $video_code = $_GET['video_code'];
    $query = "SELECT video_id,user_id,video_pic,video_name,video_description,video_code,date,category_id,count_view
            FROM video
            WHERE video_code = '$video_code'";

    $result = mysqli_query($conn, $query);
    $record = mysqli_fetch_assoc($result);
 
    $vid = $record['video_id'];
    date_default_timezone_set('Asia/Bangkok');
    $date_now = date('Y-m-d');

    // Category
    $cid = $record['category_id'];
    $queryca = mysqli_query($conn, "SELECT * FROM category WHERE category_id = '$cid'");
    $recordca = mysqli_fetch_assoc($queryca);

    // Create Playlist
    if (isset($_POST['createsubmit'])) { // Check press or not Post Comment Button
        $cpln = $_POST['plname']; // Get PL name from form
        $cuid = $_POST['uid']; // Get User id from form
        $cd = $_POST['cdate']; // Get PL date from form

        $sql = "INSERT INTO create_playlist (playlist_name, user_id, create_pl_date)
                VALUES ('$cpln', '$cuid', '$cd')";
        $result = mysqli_query($conn, $sql);
    }

    //viewcount 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "UPDATE video SET count_view = count_view+1 WHERE video_code = '$video_code'";
    $conn->query($sql);
    
    $sql = "SELECT count_view FROM video WHERE video_code = '$video_code'";
    $result = $conn->query($sql);

    // History
    $date_history = date('Y-m-d H:i:s');
    $keep_history = mysqli_query($conn,"SELECT * FROM history INNER JOIN video ON history.video_id = video.video_id INNER JOIN user ON history.user_id = user.user_id WHERE history.user_id = '$user_id' AND history.video_id = '$vid' ");
    $keep_history_fetch = mysqli_fetch_assoc($keep_history);

    if(is_null($keep_history_fetch)) {
        $history_insert = mysqli_query($conn, "INSERT INTO history(user_id, video_id, history_date) VALUES ('$user_id', '$vid', '$date_history')");
    }else{
        $history_update = mysqli_query($conn, "UPDATE history SET user_id='$user_id', video_id='$vid', history_date='$date_history' WHERE user_id='$user_id' AND video_id='$vid'");
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
  <link rel="stylesheet" href="\WDTube\css\view.css">
  <script src="/WdTube/js/main.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="/WDTube/js/popup.js" defer></script>
  <script src="/WDTube/js/clearalltext.js" defer></script>
  
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
        <div class="row">
            <div class="playvideo">
                <?php
                    echo '<iframe width="1100" height="618" src="https://www.youtube.com/embed/'.$video_code.'?modestbranding=1" 
                        rameborder="0" autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture
                        allowfullscreen></iframe>';
                ?>
                <div class="tags">
                    <?php ?>
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
                    if($fetchch['image'] == ''){
                        echo '<img src="images/default-avatar.png">';
                    }else{
                        echo '<img src="/WDTube/php/uploaded_profile/'.$fetchch['image'].'">';
                    }
                    ?>
                    <div>
                        <form action="/WDTube/php/user-profile.php" method="POST">
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
                        <?php
                            if($fetch['image'] == ''){
                                echo '<img src="images/default-avatar.png">';
                            }else{
                                echo '<img src="uploaded_profile/'.$fetch['image'].'">';
                            }
                        ?>
                        </div>
                        <div class="textbox">
                            <form action="\WDTube\php\comment.php" method="POST">
                                <input type="text" class="hidden" name="vid" value="<?=$vid?>">
                                <input type="text" class="hidden" name="comdate" value="<?=$date_now?>">
                                <input type="text" class="hidden" name="isre" value="0">
                                <textarea name="comment" class="text" id="autoresizing" placeholder="Add a comment..." onfocus="javascript:controlShow();"></textarea>
                                <div class="combtn">
                                    <input type="button" class="X" id="cancel" value="CANCEL" onclick="javascript:eraseText();controlHide();">
                                    <input type="submit" class="Sub" id="subcom" name="subcom" value="COMMENT">
                                </div>
                                <script type="text/javascript">
                                    $('#autoresizing').on('input', function () {
                                        this.style.height = 'auto';
                                        
                                        this.style.height = 
                                                (this.scrollHeight) + 'px';
                                    });
                                </script>
                            </form>
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
                                    if($u['image'] == ''){
                                        echo '<img src="images/default-avatar.png">';
                                    }else{
                                        echo '<img src="/WDTube/php/uploaded_profile/'.$u['image'].'">';
                                    }
                                ?>
                                </div>
                                <div class="scbox">
                                    <div class="name-date">
                                    <form action="/WDTube/php/user-profile.php" method="POST">
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
                    <?php echo '<a href="\WDTube\php\view.php?video_code='.$row['video_code'].'"><img src="uploaded_thumbnail/'.$row['video_pic'].'"></a>';?>
                    <div class="vid">
                        <div class="title">
                            <?php
                                echo '<a href="\WDTube\php\view.php?video_code='.$row['video_code'].'"><h2>'.$row['video_name'].'</h2></a>';
                            ?>
                        </div>
                        <div class="channel-name">
                            <?php
                                $recordchs = $row['user_id'];
                                $selectchs = mysqli_query($conn, "SELECT username, image FROM `user` WHERE user_id = '$recordchs'");
                                $fetchchs = mysqli_fetch_assoc($selectchs);
                                echo '<a href="\WDTube\php\view.php?video_code='.$row['video_code'].'"><h3>'.$fetchchs['username'].'</h3></a>';
                            ?>
                        </div>
                        <div class="count">
                            <?php
                                echo '<a href="\WDTube\php\view.php?video_code='.$row['video_code'].'"><h3>'.$row['count_view'].' views &bull; </a>';
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
            <div class="poptitle"><label>Save to...</label></div>
            <div class="close">+</div>
            <form action="" class='inpop' method="POST">
                <?php
                    $wl = mysqli_query($conn, "SELECT * FROM watchlater WHERE video_id='$vid'");
                    $swl = mysqli_fetch_assoc($wl);
                    if (is_null($swl))
                    {
                    ?>
                        <div class="inpopup">
                            <input type="text" class="hidden" name="u" value="<?php echo $user_id;?>">
                            <input type="checkbox" name="lcheck" value="<?php echo $vid;?>">
                            <label class="text">Watch later</label>
                            <h1><i class='bx bx-lock'></i></h1>
                        </div>
                    <?php
                    }else{
                    ?>
                        <div class="inpopup">
                            <input type="text" class="hidden" name="u" value="<?php echo $user_id;?>">
                            <input type="checkbox" name="lcheck" value="<?php echo $vid;?>" checked>
                            <label class="text">Watch later</label>
                            <h1><i class='bx bx-lock'></i></h1>
                        </div>
                    <?php
                    }
                ?>
                <div class="sub"><input type="submit" name="later" class="insub" value="LATER"></div>
            </form>
            <form action="update.php" class='inpop scroll' method="POST">
                <?php
                    $cresult = mysqli_query($conn, "SELECT * FROM create_playlist WHERE create_playlist.user_id = '$user_id'");
                    $countcrow = mysqli_num_rows($cresult);
                    while($crow = mysqli_fetch_array($cresult))
                    {
                        $plid=$crow['playlist_id'];
                        $querypl = mysqli_query($conn, "SELECT * FROM playlist WHERE video_id='$vid' AND playlist_id='$plid'");
                        $a=mysqli_fetch_assoc($querypl);
                        if (is_null($a)) {
                ?>
                        <div class="inpopup">
                            <input type="text" class="hidden" name="vid" value="<?php echo $vid;?>">
                            <input type="checkbox" name="listcheck[]" value="<?php echo $crow['playlist_id'];?>">;
                            <label class="text"><?php echo $crow['playlist_name']?></label>
                            <h1><i class='bx bx-lock'></i></h1>
                        </div>
                <?php
                        }else{
                        ?>
                        <div class="inpopup">
                            <input type="text" class="hidden" name="vid" value="<?php echo $vid;?>">
                            <input type="checkbox" name="listcheck[]" value="<?php echo $crow['playlist_id'];?>" checked>;
                            <label class="text"><?php echo $crow['playlist_name']?></label>
                            <h1><i class='bx bx-lock'></i></h1>
                        </div>  
                        <?php 
                        }
                    }
                
                if($countcrow!=0)
                {
                    ?>
                    <div class="sub"><input type="submit" name="listsubmit" class="insub" value="SUBMIT"></div>
                    <?php
                }
                ?>
            </form>
            <div class="cpl"><label>Create new playlist</label></div>  <!----------create playlist------------>
            <form action="" method="POST">
                <div class="incpl">
                    <label>Name</label>
                    <input type="text" class="input-cpl" name="plname" placeholder="Enter playlist name..." required>
                    <input type="text" class="hidden" name="uid" value="<?php echo $user_id;?>">
                    <input type="text" class="hidden" name="cdate" value="<?php echo $date_now;?>">
                </div>
                <div class="subcpl"><input type="submit" name="createsubmit" class="csub" value="CREATE"></div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php   // watchlater

if(isset($_POST["later"])) {
    
    $wv_id = $_POST['lcheck'];
    $u_id = $_POST['u'];
    $listquery = "INSERT INTO watchlater (user_id, video_id) VALUES ('$u_id', '$wv_id')";
    $query_run = mysqli_query($conn, $listquery);
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