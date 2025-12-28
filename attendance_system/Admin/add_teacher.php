<?php
session_start();
include "../db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['add'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    mysqli_query($conn,
        "INSERT INTO teachers (name,email,password)
         VALUES ('$name','$email','$pass')"
    );

    header("Location: teachers.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Teacher</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<form method="post" class="bg-white p-6 rounded shadow w-96">
<h2 class="text-xl font-bold mb-4">Add Teacher</h2>

<input name="name" placeholder="Teacher Name" class="border p-2 w-full mb-2" required>
<input name="email" placeholder="Email" class="border p-2 w-full mb-2" required>
<input name="password" placeholder="Password" class="border p-2 w-full mb-4" required>

<button name="add" class="bg-green-600 text-white px-4 py-2 rounded">
Add Teacher
</button>
</form>

</body>
</html>
