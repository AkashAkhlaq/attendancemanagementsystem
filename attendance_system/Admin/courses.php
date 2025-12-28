<?php
session_start();
include "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['assign'])) {
    mysqli_query($conn,
        "INSERT INTO courses (course_name,class_id,teacher_id)
         VALUES ('$_POST[course]',$_POST[class],$_POST[teacher])"
    );
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Assign Course</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<form method="post" class="bg-white p-6 rounded shadow w-96">
<h2 class="text-xl font-bold mb-4">Assign Course</h2>

<input name="course" placeholder="Course Name" class="border p-2 w-full mb-2" required>

<select name="class" class="border p-2 w-full mb-2">
<?php
$c = mysqli_query($conn,"SELECT * FROM classes");
while($r=mysqli_fetch_assoc($c)){
    echo "<option value='{$r['id']}'>{$r['class_name']}</option>";
}
?>
</select>

<select name="teacher" class="border p-2 w-full mb-4">
<?php
$t = mysqli_query($conn,"SELECT * FROM teachers");
while($r=mysqli_fetch_assoc($t)){
    echo "<option value='{$r['id']}'>{$r['name']}</option>";
}
?>
</select>

<button name="assign" class="bg-blue-600 text-white px-4 py-2 rounded">
Assign Course
</button>
</form>

</body>
</html>
