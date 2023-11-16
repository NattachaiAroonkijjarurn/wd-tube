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
    <link rel="stylesheet" href="/WDTube/css/your-video.css">
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
            <a href="\WDTube\php\your-video-playlist.php" class="sidebar-link">
              <svg class="sidebar-icon" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" ><g><path d="M19 9H2v2h17V9zm0-4H2v2h17V5zM2 15h13v-2H2v2zm15-2v6l5-3-5-3z"></path></g></svg>
              <div class="hidden-sidebar">Playlists</div>
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
      <div class="head-content">
          <h1>Channel dashboard</h1>
          <div class="upload"><a href="/WDTube/php/upload.php"><i class='bx bx-upload'></i></a></div>
      </div>
      <div class="middle-content">
        <div class="upload-box">
          <div class="inbox">
            <div class="upimg"><img src="/WDTube/img/upload.png" alt=""></div>
            <h3>Want to see metrics on your recent video?</h3>
            <h3>Upload and publish a video to get started.</h3>
            <div class="button-upload"><a href="/WDTube/php/upload.php"><p>Upload video</p></a></div>
          </div>
        </div>
        <div class="count-box">
          <div class="incountbox">
            <h3>Total video views</h3>
            <?php
              $videoview = mysqli_query($conn, "SELECT * FROM video WHERE user_id='$user_id'");
              $countvideoview = 0;
              while($videoviewf = mysqli_fetch_assoc($videoview))
              {
                $countvideoview += $videoviewf['count_view'];
              }
              echo '<h2>'.$countvideoview.'</h2><h4>views</h4>';
            ?>
            <div class="totalvideo">
              <?php
                $totalvideo = mysqli_num_rows($videoview);
                echo '<h3>Total video</h3>';
                echo '<h4>'.$totalvideo.' videos</h4>';
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>