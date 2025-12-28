<?php
session_start();
include "../db.php";

if(!isset($_SESSION['student'])){
    header("Location: ../index.php");
    exit();
}

// Fetch announcements
$announcements = mysqli_query($conn, "SELECT * FROM announcements ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Announcements</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<h1 class="text-3xl font-bold mb-6">Announcements</h1>

<div class="grid grid-cols-1 gap-4">
    <?php
    if(mysqli_num_rows($announcements) > 0){
        while($row = mysqli_fetch_assoc($announcements)){
            echo '<div class="bg-white p-4 rounded shadow">';
            echo '<h2 class="text-xl font-semibold">'.$row['title'].'</h2>';
            echo '<p class="text-gray-700 mt-2">'.$row['description'].'</p>';
            echo '<p class="text-gray-500 text-sm mt-1">Posted on: '.$row['created_at'].'</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No announcements available.</p>';
    }
    ?>
</div>

<a href="dashboard.php" class="inline-block mt-6 bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700">Back to Dashboard</a>

</body>
</html>
