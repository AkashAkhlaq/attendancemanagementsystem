<?php
session_start();
include "../db.php";

// Teacher session check
if(!isset($_SESSION['teacher'])){
    header("Location: ../index.php");
    exit();
}

$teacher_id = $_SESSION['teacher'];

// Fetch teacher info
$teacher = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM teachers WHERE id='$teacher_id'"));

// Fetch only classes assigned to this teacher via courses
$classes = mysqli_query($conn, "
    SELECT DISTINCT c.id, c.class_name 
    FROM classes c
    JOIN courses cr ON cr.class_id = c.id
    WHERE cr.teacher_id = '$teacher_id'
");

// Fetch students and their attendance if class & month selected
$students = [];
if(isset($_GET['class_id']) && isset($_GET['month'])){
    $class_id = $_GET['class_id'];
    $month = $_GET['month']; // Format: YYYY-MM

    // Fetch students
    $students = mysqli_query($conn, "
        SELECT s.*, c.class_name
        FROM students s
        JOIN classes c ON s.class_id = c.id
        WHERE s.class_id = '$class_id'
    ");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Teacher Monthly Report</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="container mx-auto p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Monthly Report - <?= $teacher['name'] ?></h1>
        <a href="dashboard.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Back to Dashboard</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="mb-6 flex flex-col md:flex-row gap-3 items-center">
        <select name="class_id" class="border p-2 rounded">
            <option value="">Select Class</option>
            <?php while($cls = mysqli_fetch_assoc($classes)) { ?>
                <option value="<?= $cls['id'] ?>" <?= (isset($_GET['class_id']) && $_GET['class_id']==$cls['id'])?'selected':''; ?>>
                    <?= $cls['class_name'] ?>
                </option>
            <?php } ?>
        </select>
        <input type="month" name="month" value="<?= $_GET['month'] ?? date('Y-m') ?>" class="border p-2 rounded">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Filter</button>
    </form>

    <!-- Students Table -->
    <?php if(!empty($students) && mysqli_num_rows($students) > 0){ ?>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border">Roll No</th>
                    <th class="py-2 px-4 border">Student Name</th>
                    <th class="py-2 px-4 border">Class</th>
                    <th class="py-2 px-4 border">Attendance (%)</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            while($stu = mysqli_fetch_assoc($students)){
                // Calculate attendance for selected month
                $month_start = $month.'-01';
                $month_end = date("Y-m-t", strtotime($month_start));

                $total_days = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM attendance 
                    WHERE student_roll='{$stu['roll_no']}' AND date BETWEEN '$month_start' AND '$month_end'"))['total'];

                $present_days = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as present FROM attendance 
                    WHERE student_roll='{$stu['roll_no']}' AND status='Present' AND date BETWEEN '$month_start' AND '$month_end'"))['present'];

                $attendance_percent = ($total_days > 0) ? round(($present_days/$total_days)*100,2) : 0;
            ?>
                <tr class="text-center">
                    <td class="py-2 px-4 border"><?= $stu['roll_no'] ?></td>
                    <td class="py-2 px-4 border"><?= $stu['name'] ?></td>
                    <td class="py-2 px-4 border"><?= $stu['class_name'] ?></td>
                    <td class="py-2 px-4 border"><?= $attendance_percent ?>%</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } elseif(isset($_GET['class_id'])){ ?>
        <p class="bg-yellow-100 p-4 rounded mt-4">No students found for this class/month.</p>
    <?php } ?>

</div>

</body>
</html>
