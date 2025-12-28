<?php
session_start();
include "../db.php";

if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit();
}

$roll = $_SESSION['student'];
$message = "";

if(isset($_POST['upload'])) {
    $file = $_FILES['work_file'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $target_dir = "../uploads/";
    
    if(!is_dir($target_dir)){
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($file_name);

    if(move_uploaded_file($file_tmp, $target_file)){
        $stmt = $conn->prepare("INSERT INTO student_work (student_roll, file_name, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $roll, $file_name, $target_file);
        if($stmt->execute()){
            $message = "File uploaded successfully!";
        } else {
            $message = "Database error!";
        }
    } else {
        $message = "Failed to upload file!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Work</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="bg-white p-10 rounded shadow-md w-96 text-center">
    <h1 class="text-2xl font-bold mb-6">Upload Your Work</h1>
    <?php if($message) echo "<p class='mb-4 text-red-600'>$message</p>"; ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="work_file" required class="mb-4">
        <button type="submit" name="upload" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Upload</button>
    </form>
</div>
</body>
</html>
