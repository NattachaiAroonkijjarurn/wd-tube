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

if(isset($_POST['removevpl'])){
    $vid = $_POST['revpl'];
    $plid = $_POST['plid'];
    $pdelete = mysqli_query($conn, "DELETE FROM playlist WHERE video_id = '$vid' AND playlist_id='$plid'");
}

if(isset($_POST['sub-editplname'])){
    $up_playlist_id = $_POST['plid'];
    $up_playlist_name = $_POST['update_name'];
    $update_playlist_name = mysqli_query($conn, "UPDATE create_playlist SET playlist_name='$up_playlist_name' WHERE user_id='$user_id' AND playlist_id='$up_playlist_id'");
}

if(isset($_POST['sub-delete'])){
    $delete_playlistid = $_POST['playlistid'];
    $delete_playlist = mysqli_query($conn, "DELETE FROM create_playlist WHERE playlist_id = '$delete_playlistid'");
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
  <link rel="stylesheet" href="/WDTube/css/playlist.css">
  <script src="/WDTube/js/main.js" defer></script>
  <script src="/WDTube/js/pl-edit.js" defer></script>
  <script src="/WDTube/js/popup.js" defer></script>
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
        <?php
            $presult = mysqli_query($conn, "SELECT * FROM create_playlist WHERE user_id='$user_id'");
            $precord = mysqli_fetch_assoc($presult);
            error_reporting(0);
            $playlistid = $precord['playlist_id'];
        ?>
        <div class="contentbox">
            <div class="sidebox">
                <?php
                    $pl = mysqli_query($conn, "SELECT * FROM playlist WHERE playlist_id='$playlistid'");
                    $spl = mysqli_fetch_assoc($pl);
                    if(is_null($spl))
                    {
                        ?>
                        <div class="topsideboxs">
                            <div class="imgwatchs"><img src="uploaded_thumbnail/no.jpg"></div>
                            <div class="titles"><p>Playlist</p></div>
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
                            <div class="playlist-select" style="width:150px;">
                                <form name="selectpl" class="spl" method="POST" action="#" onsubmit="#">
                                <select name="playlist_name" class="inspl" onchange="document.selectpl.submit();">
                                    <option selected disabled>select playlist</option>
                                    <?php
                                    if ($user_id==$precord['user_id']) {
                                        ?>
                                        <option name="plid" value="<?php echo $precord['playlist_id']?>"><?php echo $precord['playlist_name'];?></option>
                                        <?php
                                        while($precord = mysqli_fetch_assoc($presult))
                                        {
                                    ?>
                                    <option name="plid" value="<?php echo $precord['playlist_id']?>"><?php echo $precord['playlist_name'];?></option>
                                    <?php
                                        }
                                    }else{
                                        ?>
                                        <option selected disabled><?php echo 'No playlist';?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                </form>
                            </div>
                        </div>
                        <?php
                    }else{
                    ?>
                        <div class="topsidebox">
                            <div class="imgwatch">
                                <?php
                                $lselects = mysqli_query($conn, "SELECT * FROM video INNER JOIN playlist ON video.video_id = playlist.video_id");
                                $lfetchs = mysqli_fetch_assoc($lselects);
                                $lfetchs_array = mysqli_fetch_array($lselects);
                                echo '<a href="\WDTube\php\playlist_view.php?playlist_id='.$lfetchs['playlist_id'].'&video_code='.$lfetchs['video_code'].'"><img src="uploaded_thumbnail/my-best-casette-playlist-5k-za.jpg"></a>';
                                ?>
                                <a href="playlist_view.php?playlist_id=<?php echo $lfetchs['playlist_id']?>&video_code=<?php echo $lfetchs['video_code']?>"><div class="p"><p>PLAY ALL</p></div></a>
                            </div>
                            <div class="title"><p>Playlist</p></div>
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
                            <div class="playlist-select" style="width:150px;">
                                <form name="selectpl" class="spl" method="POST" action="#" onsubmit="#">
                                <select name="playlist_name" id="inspl" class="inspl" onchange="document.selectpl.submit();">
                                    <option selected disabled>select playlist</option>
                                    <?php
                                    if ($user_id==$precord['user_id']) {
                                        ?>
                                        <option name="plid" value="<?php echo $precord['playlist_id']?>"><?php echo $precord['playlist_name'];?></option>
                                        <?php
                                        while($precord = mysqli_fetch_assoc($presult))
                                        {
                                    ?>
                                    <option name="plid" value="<?php echo $precord['playlist_id']?>"><?php echo $precord['playlist_name'];?></option>
                                    <?php
                                        }
                                    }else{
                                        ?>
                                        <option selected disabled><?php echo 'No playlist';?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
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
                <div class="list-container">
                        <?php
                            if(isset($_POST["playlist_name"])) {
                                $plid = $_POST["playlist_name"];
                                $spl = mysqli_query($conn, "SELECT * FROM create_playlist WHERE playlist_id='$plid'");
                                $splr = mysqli_fetch_assoc($spl);
                                $afterspl = mysqli_query($conn, "SELECT * FROM playlist INNER JOIN video ON playlist.video_id=video.video_id WHERE playlist_id='$plid'");
                                ?>
                                <div class="stitle">
                                    <h4 id="plname"><?=$splr['playlist_name']?></h4>
                                    <button class="btn-edit" onclick="javascript: editName();">
                                        <i class="bx bxs-edit" id="editBtn" style="color: #fff; cursor: pointer;"></i>
                                    </button>
                                    <button class="btn-delete" id="button">
                                        <i class='bx bx-trash' id="deleteBtn" style="color: #fff; cursor: pointer;"></i>
                                    </button>
                                    <form action="" method="POST">
                                    <input type="text" name="update_name" class="editplname" id="editplname" value="<?php echo $splr['playlist_name']; ?>" class="box">
                                    <input type="text" name="plid" class="hidden" value="<?=$plid?>">
                                    <div class="line">
                                        <input type="button" class="X" id="cancel" value="CANCEL" onclick="javascript: closeEdit();">
                                        <input type="submit" name="sub-editplname" class="sub-editplname" id="sub-editplname" value="SAVE">
                                    </div>
                                    </form>
                                </div>
                                <?php
                                
                                    while ($aftersplr = mysqli_fetch_assoc($afterspl))
                                    {
                                        $recordchs = $aftersplr['user_id'];
                                        $video_id_pl = $aftersplr['video_id'];
                                        $selectchs = mysqli_query($conn, "SELECT username FROM `user` WHERE user_id = '$recordchs'");
                                        $fetchchs = mysqli_fetch_assoc($selectchs);
                                ?>
                                <form action="" method="POST">
                                    <div class="video">
                                        <div class="pic">
                                        <?php echo '<a href="\WDTube\php\view.php?video_code='.$aftersplr['video_code'].'"><img src="uploaded_thumbnail/'.$aftersplr['video_pic'].'"></a>';?>
                                        </div>
                                        <div class="contents">
                                            <div class="title">
                                                <?php
                                                    echo '<a href="\WDTube\php\view.php?video_code='.$aftersplr['video_code'].'"><h2>'.$aftersplr['video_name'].'</h2></a>';
                                                ?>
                                            </div>
                                            <div class="channel-name">
                                                <form action="/WDTube/php/user-profile.php" method="POST">
                                                    <input type="text" name="username" class="hidden" value="<?php echo $recordchs?>">
                                                    <?php
                                                        echo '<input type="submit" name="" id="h3" value="'.$fetchchs['username'].'">'
                                                    ?>
                                                </form>
                                            </div>
                                            <div class="edit">
                                                <??>
                                                <input type="text" name="revpl" class="hidden" value="<?=$video_id_pl?>">
                                                <input type="text" name="plid" class="hidden" value="<?=$plid?>">
                                                <input type="submit" name="removevpl" class="xbtn" value="x">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                    }
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>
    <!-----------------------POP UP---------------------------->
    <div class="bg-modal">
        <div class="modal-contents">
            <form action="" method="POST" class="inpop">
                <div class="inpopup">
                    <div class="poptitle">Delete playlist</div>
                    <div class="poptext1">Are you sure you want to delete <?=$splr['playlist_name']?>?</div>
                    <div class="poptext2">Note: Deleting playlists is a permanent action and cannot be undone.</div>
                    <input type="text" class="hidden" name="playlistid" value="<?=$plid?>">
                </div>
                <div class="choses">
                    <div class="close">CANCEL</div>
                    <input type="submit" class="sub-delete" name="sub-delete" value="DELETE">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>