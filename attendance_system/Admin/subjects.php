<?php
include "../db.php";
$subjects = mysqli_query($conn,"SELECT * FROM subjects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Subjects</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-lg">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manage Subjects</h2>
        <a href="add_subject.php"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
           + Add Subject
        </a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Subject Name</th>
                <th class="p-3 border text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($subjects)>0){ 
            while($row=mysqli_fetch_assoc($subjects)){ ?>
            <tr class="hover:bg-gray-50">
                <td class="p-3 border"><?= $row['id'] ?></td>
                <td class="p-3 border"><?= $row['subject_name'] ?></td>
                <td class="p-3 border text-center">
                    <a href="edit_subject.php?id=<?= $row['id'] ?>"
                       class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                       Edit
                    </a>
                    <a href="delete_subject.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Delete this subject?')"
                       class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm ml-2">
                       Delete
                    </a>
                </td>
            </tr>
        <?php }} else { ?>
            <tr>
                <td colspan="3" class="p-4 text-center text-gray-500">
                    No subjects found.
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>
