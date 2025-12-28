<?php
session_start();
include "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

/* ================= ADD TIMETABLE ================= */
if (isset($_POST['add'])) {
    $teacher = $_POST['teacher_id'];
    $class   = $_POST['class_id'];
    $subject = $_POST['subject_id'];
    $day     = $_POST['day'];
    $period  = $_POST['period'];
    $start   = $_POST['start_time'];
    $end     = $_POST['end_time'];

    mysqli_query($conn, "
        INSERT INTO timetable
        (teacher_id, class_id, subject_id, day, period, start_time, end_time)
        VALUES
        ('$teacher','$class','$subject','$day','$period','$start','$end')
    ");

    header("Location: timetable.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Timetable</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<h1 class="text-2xl font-bold mb-6">📅 Manage Timetable</h1>

<!-- ================= ADD FORM ================= -->
<div class="bg-white p-6 rounded shadow mb-8">
<h2 class="text-lg font-semibold mb-4">➕ Add Timetable</h2>

<form method="post" class="grid grid-cols-3 gap-4">

<select name="class_id" class="border p-2 rounded" required>
<option value="">Select Class</option>
<?php
$c = mysqli_query($conn,"SELECT * FROM classes");
while($r=mysqli_fetch_assoc($c)){
 echo "<option value='{$r['id']}'>{$r['class_name']}</option>";
}
?>
</select>

<select name="subject_id" class="border p-2 rounded" required>
<option value="">Select Subject</option>
<?php
$s = mysqli_query($conn,"SELECT * FROM subjects");
while($r=mysqli_fetch_assoc($s)){
 echo "<option value='{$r['id']}'>{$r['subject_name']}</option>";
}
?>
</select>

<select name="teacher_id" class="border p-2 rounded" required>
<option value="">Select Teacher</option>
<?php
$t = mysqli_query($conn,"SELECT * FROM teachers");
while($r=mysqli_fetch_assoc($t)){
 echo "<option value='{$r['id']}'>{$r['name']}</option>";
}
?>
</select>

<select name="day" class="border p-2 rounded" required>
<option>Monday</option>
<option>Tuesday</option>
<option>Wednesday</option>
<option>Thursday</option>
<option>Friday</option>
<option>Saturday</option>
</select>

<input name="period" placeholder="Period (1,2,3)" class="border p-2 rounded" required>

<input type="time" name="start_time" class="border p-2 rounded" required>
<input type="time" name="end_time" class="border p-2 rounded" required>

<button name="add"
class="bg-indigo-600 text-white px-4 py-2 rounded col-span-3 hover:bg-indigo-700">
Add Timetable
</button>

</form>
</div>

<!-- ================= SHOW TABLE ================= -->
<div class="bg-white p-6 rounded shadow">
<h2 class="text-lg font-semibold mb-4">📋 Timetable List</h2>

<table class="w-full border-collapse">
<thead class="bg-gray-200">
<tr>
<th class="border p-2">Class</th>
<th class="border p-2">Subject</th>
<th class="border p-2">Teacher</th>
<th class="border p-2">Day</th>
<th class="border p-2">Period</th>
<th class="border p-2">Time</th>
</tr>
</thead>

<tbody>
<?php
$q = mysqli_query($conn,"
SELECT 
t.day, t.period, t.start_time, t.end_time,
c.class_name,
s.subject_name,
te.name AS teacher_name
FROM timetable t
JOIN classes c ON t.class_id = c.id
JOIN subjects s ON t.subject_id = s.id
JOIN teachers te ON t.teacher_id = te.id
ORDER BY t.day, t.period
");

while($row=mysqli_fetch_assoc($q)){
?>
<tr class="text-center">
<td class="border p-2"><?= $row['class_name'] ?></td>
<td class="border p-2"><?= $row['subject_name'] ?></td>
<td class="border p-2"><?= $row['teacher_name'] ?></td>
<td class="border p-2"><?= $row['day'] ?></td>
<td class="border p-2"><?= $row['period'] ?></td>
<td class="border p-2">
<?= $row['start_time'] ?> - <?= $row['end_time'] ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>

</div>

</body>
</html>
