<?php
include 'server.php';

$vid = $_POST['vid'];

// playlist

if(isset($_POST["listsubmit"])) {
    
    $listcheck = $_POST['listcheck'];
    $deletepl = mysqli_query($conn, "DELETE FROM playlist WHERE video_id='$vid'");

    foreach($listcheck as $item)
    {
        $listquery = "INSERT INTO playlist (playlist_id, video_id) VALUES ('$item', '$vid')";
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
}else{
    $deletepl = mysqli_query($conn, "DELETE FROM playlist WHERE video_id='$vid'");
}

?>

<script>
    history.back();
</script>