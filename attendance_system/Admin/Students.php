<?php
session_start();
include "../db.php";
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

// Fetch all students
$students = mysqli_query($conn, "SELECT s.*, c.class_name FROM students s LEFT JOIN classes c ON s.class_id=c.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Students</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<h1 class="text-2xl font-bold mb-4">Manage Students</h1>
<a href="add_student.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Student</a>

<table class="table-auto w-full mt-4 bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Roll No</th>
            <th class="px-4 py-2">Class</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($students)) { ?>
        <tr class="text-center border-t">
            <td class="px-4 py-2"><?php echo $row['id']; ?></td>
            <td class="px-4 py-2"><?php echo $row['name']; ?></td>
            <td class="px-4 py-2"><?php echo $row['roll_no']; ?></td>
            <td class="px-4 py-2"><?php echo $row['class_name']; ?></td>
            <td class="px-4 py-2"><?php echo $row['status']; ?></td>
            <td class="px-4 py-2">
                <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-700">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>
