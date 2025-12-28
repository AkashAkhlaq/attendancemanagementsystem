<?php
session_start();
include "../db.php";

if(!isset($_SESSION['teacher'])){
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['teacher'];

// Handle file upload
if(isset($_POST['upload'])){
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $filename = $_FILES['file']['name'];
    $tmpname = $_FILES['file']['tmp_name'];
    $folder = "../uploads/".$filename;

    if(move_uploaded_file($tmpname, $folder)){
        mysqli_query($conn, "INSERT INTO student_work (student_id, course_id, file_path, upload_date) VALUES ('$student_id','$course_id','$folder',NOW())");
        $msg = "File uploaded successfully!";
    } else {
        $msg = "Failed to upload file.";
    }
}

// Fetch courses
$courses = mysqli_query($conn, "SELECT * FROM courses WHERE teacher_id='$teacher_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Student Work</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<a href="dashboard.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to Dashboard</a>

<h1 class="text-2xl font-bold mt-4 mb-4">Upload Student Work</h1>
<?php if(isset($msg)) echo "<p class='text-green-600 mb-4'>$msg</p>"; ?>

<form method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-md w-96">
    <label class="block mb-2">Select Course:</label>
    <select name="course_id" class="border rounded p-2 w-full mb-4" required>
        <?php while($course = mysqli_fetch_assoc($courses)){
            echo "<option value='{$course['id']}'>{$course['course_name']}</option>";
        } ?>
    </select>

    <label class="block mb-2">Student ID:</label>
    <input type="number" name="student_id" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">Select File:</label>
    <input type="file" name="file" class="border rounded p-2 w-full mb-4" required>

    <button type="submit" name="upload" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Upload</button>
</form>

</body>
</html>
