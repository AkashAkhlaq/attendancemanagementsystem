<?php
session_start();
include "../db.php";

if(!isset($_SESSION['student'])){
    header("Location: ../index.php");
    exit();
}

$roll = $_SESSION['student'];

// Fetch attendance
$attendance = mysqli_query($conn, "SELECT * FROM attendance WHERE student_roll='$roll' ORDER BY date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Attendance</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Your Attendance</h1>

    <table class="min-w-full bg-white rounded shadow-md">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4">Date</th>
                <th class="py-2 px-4">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($attendance)){ ?>
            <tr>
                <td class="border px-4 py-2"><?php echo $row['date']; ?></td>
                <td class="border px-4 py-2"><?php echo $row['status']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="mt-4 inline-block bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700">Back to Dashboard</a>
</div>

</body>
</html>
