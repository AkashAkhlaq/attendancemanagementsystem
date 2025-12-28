<?php
session_start();
include "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['add'])) {
    $roll     = $_POST['roll'];
$name     = $_POST['name'];
$class_id = $_POST['class'];
$password = $_POST['password']; // ✅ SIMPLE

mysqli_query($conn,"
INSERT INTO students (roll_no,name,class_id,password)
VALUES ('$roll','$name','$class_id','$password')
");



    header("Location: students.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Student</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

<form method="post" class="bg-white p-6 rounded shadow w-96 mx-auto mt-10">
<h2 class="text-xl font-bold mb-4">Add Student</h2>

<input name="roll" placeholder="Roll No" class="border p-2 w-full mb-2" required>
<input name="name" placeholder="Name" class="border p-2 w-full mb-2" required>
<input type="password" name="password" placeholder="Password" class="border p-2 w-full mb-2" required>

<select name="class" class="border p-2 w-full mb-4" required>
<option value="">Select Class</option>
<?php
$c = mysqli_query($conn,"SELECT * FROM classes");
while($r=mysqli_fetch_assoc($c)){
    echo "<option value='{$r['id']}'>{$r['class_name']}</option>";
}
?>
</select>

<button name="add" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">
Add Student
</button>
</form>

</body>
</html>