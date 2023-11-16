<?php

  include 'server.php';
  session_start();
  $user_id = $_SESSION['userid'];

  $query = "SELECT * FROM category ORDER BY category_id asc" or die("Error:" . mysqli_error());
  $result = mysqli_query($conn, $query);

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
    <title>WDStudio</title>
    <link rel="stylesheet" href="/WDTube/css/upload.css">
    <script src="/WDTube/js/main.js" defer></script>
    <script src="/WDTube/js/upload_preview.js"></script>
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
                    <input type="text" class="search-bar" placeholder="Search">
                    <button class="search-btn"><i class='bx bx-search' ></i></button>
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
                  </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
    <aside class="sidebar" data-sidebar>
      <div class="top-sidebar">
        <a href="/WDTube/php/your-video.php" class="channel-logo">
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
        <div class="hidden-sidebar channel-name"><?php echo $fetch['username'];?></div>
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
      </div><!-----
            <div class="bottom-sidebar">
              <ul class="sidebar-list">
                <li class="sidebar-list-item">
                  <a href="#" class="sidebar-link">
                    <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" class="sidebar-icon"><g><path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"></path></g></svg>
                    <div class="hidden-sidebar">Settings</div>
                  </a>
                </li>
                <li class="sidebar-list-item">
                  <a href="#" class="sidebar-link">
                    <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" class="sidebar-icon"><g><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 12h-2v-2h2v2zm0-4h-2V6h2v4z"></path></g></svg>
                    <div class="hidden-sidebar">Send Feedback</div>
                  </a>
                </li>
              </ul>
            </div>------>
    </aside>
    <div class="content">
      <div class="contentbox">
        <div class="head-content">
          <h1>Upload videos</h1>
          <a href="/WDTube/php/your-video.php"><h3>X</h3></a>
        </div>
        <hr>
        <div class="middle-content">
          <div class="icon"><img src="\WDTube\img\upload-icon.png" alt=""></div>
            
          <form action="upload.php" method="post" enctype="multipart/form-data">
              <div class="detail"><label>Details:</label><br></div>
              <input type="file" name="image" class="vpic" id="vpic" accept="image/jpg, image/jpeg, image/png" required>
                
              <div class="inputBox">
                <input type="hidden" name="userid" value="<?php echo $user_id; ?>">
                <label>Video Name:</label><br>
                <input type="text" name="video_name" class="vname" placeholder="Video Name" required><br>
                <label>Video Code:</label><br>
                <input type="text" name="video_code" class="vcode" placeholder="Video Code" required><br>
                <input type="hidden" name="date_time" value="<?php echo $date_now; ?>">
                <label>Category</label><br>
                <select name="category" class="vcate" required>
                  <option value="">-Choose-</option>
                  <?php foreach($result as $results){?>
                  <option value="<?php echo $results["category_id"];?>">
                    <?php echo $results["category_name"]; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="inputBox1">
                <label>Description:</label><br>
                <textarea name="description" id="vdes" placeholder="Description"></textarea>
                <input type="hidden" name="count_view" value="0">
                <!--<input type="text" name="description" id="vdes" placeholder="Description"><br>--->
              </div>
            <div class="btn-upload"><input class="click" type="submit" name="submit" value="upload"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php

if(isset($_POST['submit'])) {

      $videopic = $_FILES['image']['name'];
      $videopic_size = $_FILES['image']['size'];
      $videopic_tmp_name = $_FILES['image']['tmp_name'];
      $videopic_folder = 'uploaded_thumbnail/'.$videopic;
      $uid = $_POST['userid'];
      $countview = $_POST['count_view'];
      $videoname = $_POST['video_name'];
      $videodes = $_POST['description'];
      $videolink = $_POST['video_code'];
      $videodate = $_POST['date_time'];
      $videodcate = $_POST['category'];
      
      if($videopic_size > 5000000){
          $message[] = 'image size is too large!';
        }else{
          $sql = mysqli_query($conn,"INSERT INTO video(user_id, video_pic, video_name, video_description, video_code, date, category_id, count_view) VALUES('$uid', '$videopic', '$videoname', '$videodes', '$videolink', '$videodate', '$videodcate', '$countview')") or die('query failed');
          
          if($sql){
            move_uploaded_file($videopic_tmp_name, $videopic_folder);
            $message[] = 'uploaded successfully!';
          }else{
            $message[] = 'uploaded failed!';
        }
      }
}
    
?>