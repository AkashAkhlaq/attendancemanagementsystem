<?php
include "../db.php";
$teachers = mysqli_query($conn, "SELECT * FROM teachers");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Teachers</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto p-6">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manage Teachers</h1>
        <a href="add_teacher.php"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
            + Add Teacher
        </a>
    </div>

    <!-- Teachers Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-800 text-white text-left">
                    <th class="px-4 py-3 w-16 text-center">ID</th>
                    <th class="px-4 py-3 w-1/4">Name</th>
                    <th class="px-4 py-3 w-1/3">Email</th>
                    <th class="px-4 py-3 w-1/4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
            <?php if(mysqli_num_rows($teachers) > 0){ ?>
                <?php while($t = mysqli_fetch_assoc($teachers)){ ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3 text-center font-medium">
                        <?= $t['id'] ?>
                    </td>

                    <td class="px-4 py-3 break-words">
                        <?= htmlspecialchars($t['name']) ?>
                    </td>

                    <td class="px-4 py-3 break-all">
                        <?= htmlspecialchars($t['email']) ?>
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-2 flex-wrap">
                            <a href="assign_course.php?id=<?= $t['id'] ?>"
                               class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                               Assign Course
                            </a>

                            <a href="edit_teacher.php?id=<?= $t['id'] ?>"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                               Edit
                            </a>

                            <a href="delete_teacher.php?id=<?= $t['id'] ?>"
                               onclick="return confirm('Are you sure you want to delete this teacher?')"
                               class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                               Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-500">
                        No teachers found.
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
