<?php
include "../db.php";

// Fetch classes
$classes = mysqli_query($conn, "SELECT * FROM classes ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Classes</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manage Classes</h1>
        <a href="add_class.php"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
           + Add Class
        </a>
    </div>

    <!-- Classes Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-4 py-3 w-20 text-center">ID</th>
                    <th class="px-4 py-3">Class Name</th>
                    <th class="px-4 py-3 w-60 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
            <?php if(mysqli_num_rows($classes) > 0){ ?>
                <?php while($c = mysqli_fetch_assoc($classes)){ ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3 text-center font-medium">
                        <?= $c['id'] ?>
                    </td>

                    <td class="px-4 py-3 break-words">
                        <?= htmlspecialchars($c['class_name']) ?>
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-3">
                            <a href="edit_class.php?id=<?= $c['id'] ?>"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-1 rounded text-sm">
                               Edit
                            </a>

                            <a href="delete_class.php?id=<?= $c['id'] ?>"
                               onclick="return confirm('Are you sure you want to delete this class?')"
                               class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-sm">
                               Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3" class="text-center py-6 text-gray-500">
                        No classes added yet.
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
