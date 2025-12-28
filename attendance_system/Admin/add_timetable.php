<?php
session_start();
include "../db.php";
if(!isset($_SESSION['admin'])){ header("Location: ../index.php"); exit(); }

if(isset($_POST['add'])){
    mysqli_query($conn,"
        INSERT INTO timetable (class_id,course_id,day,start_time,end_time,room)
        VALUES (
            '{$_POST['class']}',
            '{$_POST['course']}',
            '{$_POST['day']}',
            '{$_POST['start']}',
            '{$_POST['end']}',
            '{$_POST['room']}'
        )
    ");
    header("Location: timetable.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Time Table</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<form method="post" class="bg-white p-6 w-96 rounded shadow">
<h2 class="text-xl font-bold mb-4">Add Time Table</h2>

<select name="class" class="border p-2 w-full mb-2">
<?php
$c=mysqli_query($conn,"SELECT * FROM classes");
while($r=mysqli_fetch_assoc($c))
 echo "<option value='{$r['id']}'>{$r['class_name']}</option>";
?>
</select>

<select name="course" class="border p-2 w-full mb-2">
<?php
$co=mysqli_query($conn,"SELECT * FROM courses");
while($r=mysqli_fetch_assoc($co))
 echo "<option value='{$r['id']}'>{$r['course_name']}</option>";
?>
</select>

<select name="day" class="border p-2 w-full mb-2">
<option>Monday</option><option>Tuesday</option><option>Wednesday</option>
<option>Thursday</option><option>Friday</option>
</select>

<input type="time" name="start" class="border p-2 w-full mb-2">
<input type="time" name="end" class="border p-2 w-full mb-2">
<input name="room" placeholder="Room" class="border p-2 w-full mb-4">

<button name="add" class="bg-blue-600 text-white px-4 py-2 rounded w-full">
Save
</button>
</form>
</body>
</html>
