<?php

include 'server.php';
session_start();

if (isset($_POST['subcom'])) {

$user_id = $_SESSION['userid'];
$vid = $_POST['vid'];
$comtext = $_POST['comment'];
$comdate = $_POST['comdate'];

$result = mysqli_query($conn, "INSERT INTO comment(user_id, video_id, comment_text, comment_date) VALUES('$user_id', '$vid', '$comtext', '$comdate')") or die('query failed');

}

?>

<script>
    history.back();
</script>