<?php
session_start();
include "../db.php";

if(!isset($_SESSION['teacher'])){
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['teacher'];

$courses = mysqli_query($conn, "SELECT * FROM courses WHERE teacher_id='$teacher_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Courses</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<h1 class="text-2xl font-bold mb-4">My Courses</h1>
<a href="dashboard.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back</a>

<div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
<?php
if(mysqli_num_rows($courses) > 0){
    while($course = mysqli_fetch_assoc($courses)){
        echo "<div class='bg-white p-4 rounded shadow-md'>
                <h2 class='font-bold'>{$course['course_name']}</h2>
                <p>Class ID: {$course['class_id']}</p>
                <a href='attendance_manage.php?course_id={$course['id']}' class='bg-green-600 text-white px-3 py-1 rounded mt-2 inline-block hover:bg-green-700'>Manage Attendance</a>
              </div>";
    }
} else {
    echo "<p>No courses assigned.</p>";
}
?>
</div>

</body>
</html>
