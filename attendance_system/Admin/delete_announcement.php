<?php
include "../db.php";
$id = $_GET['id'] ?? 0;

if($id){
    mysqli_query($conn,"DELETE FROM announcements WHERE id='$id'");
}
header("Location: announcements.php");
exit();
