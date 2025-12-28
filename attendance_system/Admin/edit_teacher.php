<?php
session_start();
include "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];

$teacher = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM teachers WHERE id=$id")
);

if (isset($_POST['update'])) {
    mysqli_query($conn,
        "UPDATE teachers SET
         name='$_POST[name]',
         email='$_POST[email]'
         WHERE id=$id"
    );
    header("Location: teachers.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Teacher</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<form method="post" class="bg-white p-6 rounded shadow w-96">
<h2 class="text-xl font-bold mb-4">Edit Teacher</h2>

<input name="name" value="<?= $teacher['name'] ?>" class="border p-2 w-full mb-2">
<input name="email" value="<?= $teacher['email'] ?>" class="border p-2 w-full mb-4">

<button name="update" class="bg-blue-600 text-white px-4 py-2 rounded">
Update
</button>
</form>

</body>
</html>
