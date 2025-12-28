<?php
include "../db.php";
$msg="";

if(isset($_POST['add_announcement'])){
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if($title!="" && $description!=""){
        mysqli_query($conn,"INSERT INTO announcements (title, description) VALUES ('$title','$description')");
        header("Location: announcements.php");
        exit();
    } else {
        $msg="All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Announcement</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">

<h2 class="text-2xl font-bold mb-4 text-center">Add Announcement</h2>

<?php if($msg){ ?>
<p class="text-red-600 mb-3 text-center"><?= $msg ?></p>
<?php } ?>

<form method="post">
    <label class="block mb-2 font-medium">Title</label>
    <input type="text" name="title" class="w-full border px-3 py-2 rounded mb-4">

    <label class="block mb-2 font-medium">Description</label>
    <textarea name="description" class="w-full border px-3 py-2 rounded mb-4"></textarea>

    <div class="flex justify-between">
        <a href="announcements.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back</a>
        <button name="add_announcement" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Add</button>
    </div>
</form>

</div>
</body>
</html>
