<?php
session_start();
include "../db.php";

if(!isset($_SESSION['teacher'])){
    header("Location: index.php");
    exit();
}

$teacher_id = $_SESSION['teacher'];

// Fetch teacher info
$teacher = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teachers WHERE id='$teacher_id'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Teacher Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <!-- Teacher Info -->
    <div class="bg-white p-6 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-4">Welcome, <?php echo $teacher['name']; ?></h1>
        <p><strong>Email:</strong> <?php echo $teacher['email']; ?></p>
    </div>

    <!-- Dashboard Buttons -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <a href="courses.php" class="bg-blue-600 text-white p-4 rounded text-center hover:bg-blue-700">My Courses</a>
        <a href="attendance_manage.php" class="bg-green-600 text-white p-4 rounded text-center hover:bg-green-700">Manage Attendance</a>
        <a href="student_work.php" class="bg-yellow-500 text-white p-4 rounded text-center hover:bg-yellow-600">Student Work</a>
        <a href="announcements.php" class="bg-purple-600 text-white p-4 rounded text-center hover:bg-purple-700">Announcements</a>
        <a href="monthly_report.php" class="bg-pink-500 text-white p-4 rounded text-center hover:bg-pink-600">Monthly Report</a>
        <a href="logout.php" class="bg-red-600 text-white p-4 rounded text-center hover:bg-red-700">Logout</a>

    </div>

    <!-- Courses Assigned to Teacher -->
    <div class="bg-white p-6 rounded shadow-md mt-6">
        <h2 class="text-xl font-bold mb-3">Assigned Courses</h2>
        <ul class="list-disc list-inside">
        <?php
        $courses = mysqli_query($conn, "SELECT * FROM courses WHERE teacher_id='$teacher_id'");
        if(mysqli_num_rows($courses) > 0){
            while($course = mysqli_fetch_assoc($courses)){
                echo "<li>{$course['course_name']} - Class ID: {$course['class_id']}</li>";
            }
        } else {
            echo "<li>No courses assigned yet.</li>";
        }
        ?>
        </ul>
    </div>
</div>

</body>
</html>
