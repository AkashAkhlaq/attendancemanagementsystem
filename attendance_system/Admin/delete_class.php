<?php
include "../db.php";

$id = $_GET['id'] ?? 0;

if($id){
    mysqli_query($conn,"DELETE FROM classes WHERE id='$id'");
}

header("Location: classes.php");
exit();
