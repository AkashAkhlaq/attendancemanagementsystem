<?php
include "../db.php";
$id = $_GET['id'] ?? 0;

$announcement = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM announcements WHERE id='$id'"));

if(!$announcement){
    header("Location: announcements.php");
    exit();
}

if(isset($_POST['update_announcement'])){
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if($title!="" && $description!=""){
        mysqli_query($conn,"UPDATE announcements SET title='$title', description='$description' WHERE id='$id'");
        header("Location: announcements.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Announcement</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">

<h2 class="text-2xl font-bold mb-4 text-center">Edit Announcement</h2>

<form method="post">
    <label class="block mb-2 font-medium">Title</label>
    <input type="text" name="title" value="<?= htmlspecialchars($announcement['title']) ?>"
           class="w-full border px-3 py-2 rounded mb-4">

    <label class="block mb-2 font-medium">Description</label>
    <textarea name="description" class="w-full border px-3 py-2 rounded mb-4"><?= htmlspecialchars($announcement['description']) ?></textarea>

    <div class="flex justify-between">
        <a href="announcements.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back</a>
        <button name="update_announcement" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Update</button>
    </div>
</form>

</div>
</body>
</html>
