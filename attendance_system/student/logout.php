<?php
session_start();
unset($_SESSION['student']);
session_destroy();
header("Location: ../index.php");
exit();
?>
