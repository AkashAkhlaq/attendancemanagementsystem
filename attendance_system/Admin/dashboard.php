<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- ================= TOP NAVBAR ================= -->
<nav class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Attendance Management System</h1>
    <div class="flex items-center gap-4">
        <span class="font-semibold">Admin Panel</span>
        <a href="../logout.php" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">
            Logout
        </a>
    </div>
</nav>

<!-- ================= MAIN CONTENT ================= -->
<div class="container mx-auto p-6">

<!-- ===== DASHBOARD HEADER ===== -->
<div class="flex flex-col md:flex-row justify-between items-center mb-6">
    <div>
        <h2 class="text-3xl font-bold">Dashboard</h2>
        <p class="text-gray-600">Welcome back, Admin</p>
    </div>

    <!-- 📅 Calendar -->
    <div class="bg-white p-4 rounded shadow-md mt-4 md:mt-0">
        <p class="font-semibold text-gray-700">Today</p>
        <p class="text-xl font-bold">
            <?php echo date("l, d M Y"); ?>
        </p>
    </div>
</div>

<!-- ===== STATS CARDS ===== -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

<div class="bg-white p-5 rounded shadow border-l-4 border-blue-600">
    <h3 class="text-gray-500">Students</h3>
    <p class="text-2xl font-bold">Manage</p>
</div>

<div class="bg-white p-5 rounded shadow border-l-4 border-green-600">
    <h3 class="text-gray-500">Teachers</h3>
    <p class="text-2xl font-bold">Manage</p>
</div>

<div class="bg-white p-5 rounded shadow border-l-4 border-purple-600">
    <h3 class="text-gray-500">Classes</h3>
    <p class="text-2xl font-bold">Manage</p>
</div>

<div class="bg-white p-5 rounded shadow border-l-4 border-yellow-600">
    <h3 class="text-gray-500">Courses</h3>
    <p class="text-2xl font-bold">Assign</p>
</div>

</div>

<!-- ===== ACTION BUTTONS ===== -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

<a href="students.php" class="bg-blue-600 text-white p-6 rounded shadow hover:bg-blue-700 text-center">
    👨‍🎓 Manage Students
</a>

<a href="teachers.php" class="bg-green-600 text-white p-6 rounded shadow hover:bg-green-700 text-center">
    👨‍🏫 Manage Teachers
</a>

<a href="classes.php" class="bg-purple-600 text-white p-6 rounded shadow hover:bg-purple-700 text-center">
    🏫 Manage Classes
</a>

<a href="subjects.php" class="bg-pink-600 text-white p-6 rounded shadow hover:bg-pink-700 text-center">
    📘 Manage Subjects
</a>

<a href="courses.php" class="bg-yellow-600 text-white p-6 rounded shadow hover:bg-yellow-700 text-center">
    📚 Assign Courses
</a>

<a href="timetable.php" class="bg-indigo-600 text-white p-6 rounded shadow hover:bg-indigo-700 text-center">
    🗓️ Manage Time Table
</a>

<a href="announcements.php" class="bg-red-600 text-white p-6 rounded shadow hover:bg-red-700 text-center">
    📢 Announcements
</a>

<a href="monthly_reports.php" class="bg-gray-800 text-white p-6 rounded shadow hover:bg-gray-900 text-center">
    📊 Monthly Reports
</a>

</div>

</div>

</body>
</html>
