<?php
include 'server.php';

if(isset($_POST["listremove"])) {
    
    $listcheck = $_POST['listcheck'];
    foreach($listcheck as $item)
    {
        $listquery = "DELETE FROM watchlater WHERE video_id = $item";
        $query_run = mysqli_query($conn, $listquery);
    }
}
?>

<script>
    history.back();
</script>