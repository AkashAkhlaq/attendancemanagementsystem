<?php
session_start();
include "../db.php";

// Check if teacher is logged in
if(!isset($_SESSION['teacher'])){
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['teacher'];

// Handle form submission
if(isset($_POST['add'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    mysqli_query($conn, "INSERT INTO announcements (teacher_id, title, description, created_at) 
                        VALUES ('$teacher_id','$title','$description', NOW())");
    $success = "Announcement added successfully!";
}

// Fetch all announcements by this teacher
$announcements = mysqli_query($conn, "SELECT * FROM announcements WHERE teacher_id='$teacher_id' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Announcements</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="container mx-auto">

    <h1 class="text-2xl font-bold mb-4">Add Announcement</h1>

    <?php if(isset($success)) echo "<p class='text-green-600 mb-4'>$success</p>"; ?>

    <form method="POST" class="bg-white p-6 rounded shadow-md mb-6">
        <input type="text" name="title" placeholder="Title" class="border p-2 w-full mb-4" required>
        <textarea name="description" placeholder="Description" class="border p-2 w-full mb-4" required></textarea>
        <button type="submit" name="add" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Add Announcement</button>
    </form>

    <h2 class="text-xl font-bold mb-3">Your Announcements</h2>
    <ul class="list-disc list-inside bg-white p-6 rounded shadow-md">
        <?php
        if(mysqli_num_rows($announcements) > 0){
            while($row = mysqli_fetch_assoc($announcements)){
                echo "<li><strong>".$row['title']."</strong> - ".$row['description']." <small>(".$row['created_at'].")</small></li>";
            }
        } else {
            echo "<li>No announcements added yet.</li>";
        }
        ?>
    </ul>

    <a href="dashboard.php" class="inline-block mt-4 bg-red-600 text-white p-2 rounded hover:bg-red-700">Back to Dashboard</a>
</div>

</body>
</html>
