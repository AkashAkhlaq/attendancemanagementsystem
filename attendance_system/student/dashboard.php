<?php
session_start();
include "../db.php";

// Check if student is logged in
if (!isset($_SESSION['student'])) {
    header("Location: ../index.php");
    exit();
}

$roll = $_SESSION['student'];

// Fetch student info along with class name
$student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT s.*, c.class_name 
    FROM students s 
    LEFT JOIN classes c ON s.class_id = c.id 
    WHERE s.roll_no='$roll'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <!-- Student Info -->
    <div class="bg-white p-6 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-4">Welcome, <?php echo $student['name']; ?></h1>
        <p><strong>Roll No:</strong> <?php echo $student['roll_no']; ?></p>
        <p><strong>Class:</strong> <?php echo $student['class_name']; ?></p>
    </div>

    <!-- Dashboard Buttons -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <a href="attendance.php" class="bg-blue-600 text-white p-4 rounded text-center hover:bg-blue-700">Attendance</a>
        <a href="timetable.php" class="bg-green-600 text-white p-4 rounded text-center hover:bg-green-700">Time Table</a>
        <a href="announcements.php" class="bg-yellow-500 text-white p-4 rounded text-center hover:bg-yellow-600">Announcements</a>
        <a href="courses.php" class="bg-purple-600 text-white p-4 rounded text-center hover:bg-purple-700">Courses</a>
        <a href="upload_work.php" class="bg-pink-500 text-white p-4 rounded text-center hover:bg-pink-600">Upload Work</a>
        <!-- Fixed Logout Link -->
        <a href="logout.php" class="bg-red-600 text-white p-4 rounded text-center hover:bg-red-700">Logout</a>
    </div>

    <!-- Courses List -->
    <div class="bg-white p-6 rounded shadow-md mt-6">
        <h2 class="text-xl font-bold mb-3">Your Courses</h2>
        <ul class="list-disc list-inside">
        <?php
        $courses = mysqli_query($conn, "SELECT * FROM courses WHERE class_id='{$student['class_id']}'");
        if(mysqli_num_rows($courses) > 0){
            while($course = mysqli_fetch_assoc($courses)){
                echo "<li>{$course['course_name']} - Teacher: {$course['teacher_name']}</li>";
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
