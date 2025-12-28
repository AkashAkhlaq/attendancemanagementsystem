<?php
session_start();
include "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];

$student = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM students WHERE id=$id")
);

if (isset($_POST['update'])) {
    mysqli_query($conn,"
        UPDATE students SET
        roll_no='$_POST[roll]',
        name='$_POST[name]',
        class_id='$_POST[class]'
        WHERE id=$id
    ");
    header("Location: students.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Student</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

<form method="post" class="bg-white p-6 rounded shadow w-96">
<h2 class="text-xl font-bold mb-4">Edit Student</h2>

<input name="roll" value="<?php echo $student['roll_no']; ?>" class="border p-2 w-full mb-2">
<input name="name" value="<?php echo $student['name']; ?>" class="border p-2 w-full mb-2">

<select name="class" class="border p-2 w-full mb-4">
<?php
$c = mysqli_query($conn,"SELECT * FROM classes");
while($r=mysqli_fetch_assoc($c)){
    $sel = $student['class_id']==$r['id'] ? "selected" : "";
    echo "<option value='{$r['id']}' $sel>{$r['class_name']}</option>";
}
?>
</select>

<button name="update" class="bg-blue-600 text-white px-4 py-2 rounded">
Update
</button>
</form>

</body>
</html>
