<?php
include "../db.php";
$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM teachers WHERE id=$id");
header("Location: teachers.php");
