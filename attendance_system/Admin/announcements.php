<?php
include "../db.php";

$announcements = mysqli_query($conn,"SELECT * FROM announcements ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Announcements</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-lg">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manage Announcements</h2>
        <a href="add_announcement.php"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
           + Add Announcement
        </a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Title</th>
                <th class="p-3 border">Description</th>
                <th class="p-3 border text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if(mysqli_num_rows($announcements)>0){
            while($row=mysqli_fetch_assoc($announcements)){ ?>
            <tr class="hover:bg-gray-50">
                <td class="p-3 border"><?= $row['id'] ?></td>
                <td class="p-3 border"><?= $row['title'] ?></td>
                <td class="p-3 border"><?= $row['description'] ?></td>
                <td class="p-3 border text-center">
                    <a href="edit_announcement.php?id=<?= $row['id'] ?>"
                       class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">Edit</a>
                    <a href="delete_announcement.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Delete this announcement?')"
                       class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm ml-2">Delete</a>
                </td>
            </tr>
        <?php } } else { ?>
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">No announcements found.</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>
</body>
</html>
