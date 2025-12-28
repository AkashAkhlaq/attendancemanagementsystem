<?php
session_start();
include "../db.php";

if (!isset($_SESSION['student'])) {
    header("Location: ../index.php");
    exit();
}

$roll = $_SESSION['student'];

/* ===== GET STUDENT CLASS ===== */
$student = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT class_id FROM students WHERE roll_no='$roll'")
);

$class_id = $student['class_id'];

/* ===== FETCH TIMETABLE WITH JOINS ===== */
$timetable = mysqli_query($conn, "
    SELECT 
        t.day,
        t.period,
        t.start_time,
        t.end_time,
        s.subject_name,
        te.name AS teacher_name
    FROM timetable t
    JOIN subjects s ON t.subject_id = s.id
    JOIN teachers te ON t.teacher_id = te.id
    WHERE t.class_id = '$class_id'
    ORDER BY 
        FIELD(t.day,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'),
        t.period
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Timetable</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">

<h1 class="text-2xl font-bold mb-4">📘 My Class Timetable</h1>

<table class="w-full border-collapse">
<thead class="bg-gray-200">
<tr>
    <th class="border p-2">Day</th>
    <th class="border p-2">Period</th>
    <th class="border p-2">Subject</th>
    <th class="border p-2">Teacher</th>
    <th class="border p-2">Time</th>
</tr>
</thead>

<tbody>
<?php if(mysqli_num_rows($timetable) > 0){ ?>
<?php while($row = mysqli_fetch_assoc($timetable)){ ?>
<tr class="text-center">
    <td class="border p-2"><?= $row['day'] ?></td>
    <td class="border p-2"><?= $row['period'] ?></td>
    <td class="border p-2"><?= $row['subject_name'] ?></td>
    <td class="border p-2"><?= $row['teacher_name'] ?></td>
    <td class="border p-2">
        <?= $row['start_time'] ?> - <?= $row['end_time'] ?>
    </td>
</tr>
<?php } ?>
<?php } else { ?>
<tr>
<td colspan="5" class="text-center p-4 text-gray-500">
No timetable assigned yet.
</td>
</tr>
<?php } ?>
</tbody>
</table>

<a href="dashboard.php"
class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
⬅ Back to Dashboard
</a>

</div>

</body>
</html>
