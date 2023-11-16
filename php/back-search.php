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
    <title>WDStudio</title>
    <link rel="stylesheet" href="/WDTube/css/back-search.css">
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
                  <span class="logo-name">WDStudio</span>
                </a>
                <div class="search">
                  <form action="/WDTube/php/back-search.php" method="POST">
                    <input type="text" name="search" class="search-bar" placeholder="Search">
                    <button type="submit" name="submit-search" class="search-btn"><i class='bx bx-search'></i></button>
                  </form>
                </div>
                <div class="icon">
                  <div class="icon-button">
                    <a href="\WDTube\php\upload.php"><i class='bx bx-video-plus' ><h1>CREATE</h1></i></a>
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
    <aside class="sidebar" data-sidebar>
      <div class="top-sidebar">
        <a href="" class="channel-logo">
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
        </a>
        <div class="hidden-sidebar your-channel">Your channel</div>
        <div class="hidden-sidebar channel-name"><?php echo $fetch['username']; ?></div>
      </div>
      <div class="middle-sidebar">
        <ul class="sidebar-list">
          <li class="sidebar-list-item active">
            <a href="\WDTube\php\your-video.php" class="sidebar-link active">
              <svg class="sidebar-icon active" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" ><g ><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"></path></g></svg>
              <div class="hidden-sidebar">Dashboard</div>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="\WDTube\php\content.php" class="sidebar-link">
              <svg viewBox="0 0 24 24" class="sidebar-icon" preserveAspectRatio="xMidYMid meet" focusable="false"><g><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8 12.5v-9l6 4.5-6 4.5z"></path></g></svg>
              <div class="hidden-sidebar">Content</div>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" class="sidebar-link">
              <svg class="sidebar-icon" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" ><g><path d="M19 9H2v2h17V9zm0-4H2v2h17V5zM2 15h13v-2H2v2zm15-2v6l5-3-5-3z"></path></g></svg>
              <div class="hidden-sidebar">Playlists</div>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" class="sidebar-link">
              <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" class="sidebar-icon"><g><path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"></path></g></svg>
              <div class="hidden-sidebar">Comments</div>
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="\WDTube\php\customization1.php" class="sidebar-link">
              <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" class="sidebar-icon"><g><path d="M0 0h24v24H0z" fill="none"></path><path d="M7.5 5.6L10 7 8.6 4.5 10 2 7.5 3.4 5 2l1.4 2.5L5 7zm12 9.8L17 14l1.4 2.5L17 19l2.5-1.4L22 19l-1.4-2.5L22 14zM22 2l-2.5 1.4L17 2l1.4 2.5L17 7l2.5-1.4L22 7l-1.4-2.5zm-7.63 5.29c-.39-.39-1.02-.39-1.41 0L1.29 18.96c-.39.39-.39 1.02 0 1.41l2.34 2.34c.39.39 1.02.39 1.41 0L16.7 11.05c.39-.39.39-1.02 0-1.41l-2.33-2.35zm-1.03 5.49l-2.12-2.12 2.44-2.44 2.12 2.12-2.44 2.44z"></path></g></svg>
              <div class="hidden-sidebar">Customization</div>
            </a>
          </li>
        </ul>
      </div>
    </aside>
    <div class="content">
        <div class="video-container">
            <?php
            if(isset($_POST['submit-search'])) {
                $search = mysqli_real_escape_string($conn, $_POST['search']);

                $query = "SELECT * FROM video WHERE user_id = '$user_id' AND video_name LIKE '%$search%'";

                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) != 0) {
                    while ($record = mysqli_fetch_assoc($result))
                    {
                    ?>
                    <div class="video">
                        <div class="thumbnail">
                            <?php echo '<a href="\WDTube\php\viewnologin.php?video_code='.$record['video_code'].'"><img src="/WDTube/php/uploaded_thumbnail/'.$record['video_pic'].'"></a>';?>
                        </div>
                        <div class="info">
                            <div class="title">
                                <?php
                                    echo '<a href="\WDTube\php\viewnologin.php"><h2>'.$record['video_name'].'</h2></a>';
                                ?>
                            </div>
                            <div class="count">
                                <?php
                                    echo '<a href="\WDTube\php\viewnologin.php"><h3>'.$record['count_view'].' views</h3></a>';
                                ?>
                            </div>
                            <div class="channel-icon">
                                <?php
                                $recordch = $record['user_id'];
                                $selectch = mysqli_query($conn, "SELECT username, image FROM `user` WHERE user_id = '$recordch'");
                                $fetchch = mysqli_fetch_assoc($selectch);
                                if($fetchch['image'] == ''){
                                    echo '<img src="images/default-avatar.png">';
                                }else{
                                    echo '<a href="/WDTube/php/user-profile.php"><img src="/WDTube/php/uploaded_profile/'.$fetchch['image'].'"></a>';
                                }
                                ?>
                            </div>
                            <div class="channel-name">
                                <?php
                                    echo '<a href="/php/user-profile.php"><h3>'.$fetchch['username'].'</h3></a>';
                                ?>
                            </div>
                            <div class="description">
                                <?php
                                    echo '<a href="\WDTube\php\viewnologin.php?video_code='.$record['video_code'].'"><p>'.$record['video_description'].'</p></a>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }else {
                    echo '<h6>Could not find a video...</h6>';
                }
            }
            ?>
        </div>
    </div>
  </div>
</body>
</html>