<?php
include "../db.php";
$teacher_id = $_GET['id'];

$teacher = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM teachers WHERE id=$teacher_id"));

$courses = mysqli_query($conn,"SELECT * FROM courses");

if(isset($_POST['assign'])){
  $course_id = $_POST['course'];
  mysqli_query($conn,
  "UPDATE courses SET teacher_id=$teacher_id WHERE id=$course_id");
  header("Location: teachers.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<h2 class="text-xl font-bold mb-4">
Assign Course to <?= $teacher['name'] ?>
</h2>

<form method="POST" class="bg-white p-6 w-96 rounded shadow">

<select name="course" class="border p-2 w-full mb-3" required>
<option value="">Select Course</option>
<?php while($c = mysqli_fetch_assoc($courses)){ ?>
<option value="<?= $c['id'] ?>">
<?= $c['course_name'] ?>
</option>
<?php } ?>
</select>

<button name="assign" class="bg-green-600 text-white px-4 py-2 rounded">
Assign Course
</button>

</form>

</body>
</html>
