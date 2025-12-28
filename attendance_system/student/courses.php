<?php
session_start();
include "../db.php";

// Check if student is logged in
if (!isset($_SESSION['student'])) {
    header("Location: ../index.php");
    exit();
}

$roll = $_SESSION['student'];

// Fetch student info
$student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE roll_no='$roll'"));

// Fetch courses assigned to this student
// Assuming course table has: id, course_name, teacher_name, class_id
$courses = mysqli_query($conn, "SELECT co.course_name, co.teacher_name, c.class_name 
    FROM courses co 
    JOIN classes c ON co.class_id = c.id
    WHERE co.class_id = '{$student['class_id']}'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Courses</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Courses</h1>
        <a href="dashboard.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Back to Dashboard</a>
    </div>

    <div class="bg-white p-6 rounded shadow-md">
        <table class="min-w-full table-auto border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 border">Course Name</th>
                    <th class="px-4 py-2 border">Teacher</th>
                    <th class="px-4 py-2 border">Class</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($courses) > 0){
                    while($row = mysqli_fetch_assoc($courses)){
                        echo "<tr>
                            <td class='px-4 py-2 border'>{$row['course_name']}</td>
                            <td class='px-4 py-2 border'>{$row['teacher_name']}</td>
                            <td class='px-4 py-2 border'>{$row['class_name']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='px-4 py-2 border text-center'>No courses assigned yet</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
