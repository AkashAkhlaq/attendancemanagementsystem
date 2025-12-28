<?php
session_start();
include "../db.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../index.php");
    exit();
}

$month = $_GET['month'] ?? date('m');
$year  = $_GET['year'] ?? date('Y');
$class_id = $_GET['class_id'] ?? '';

$classes = mysqli_query($conn, "SELECT * FROM classes");

$students = [];
if($class_id){
    $students = mysqli_query($conn, "
        SELECT s.*, c.class_name 
        FROM students s
        JOIN classes c ON s.class_id=c.id
        WHERE s.class_id='$class_id'
    ");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Monthly Reports</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="container mx-auto">
<h1 class="text-2xl font-bold mb-4">Admin - Monthly Attendance Reports</h1>

<form method="GET" class="mb-6 flex gap-3">
    <select name="class_id" class="border p-2 rounded">
        <option value="">Select Class</option>
        <?php while($cls=mysqli_fetch_assoc($classes)){ ?>
            <option value="<?= $cls['id'] ?>" <?= ($class_id==$cls['id'])?'selected':''; ?>><?= $cls['class_name'] ?></option>
        <?php } ?>
    </select>
    <input type="month" name="month" value="<?= $year.'-'.str_pad($month,2,'0',STR_PAD_LEFT) ?>" class="border p-2 rounded">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
</form>

<?php if($class_id && $students){ ?>
<table class="min-w-full bg-white rounded shadow-md">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2">Roll No</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Class</th>
            <th class="px-4 py-2">Present</th>
            <th class="px-4 py-2">Absent</th>
        </tr>
    </thead>
    <tbody>
        <?php while($st=mysqli_fetch_assoc($students)){
            $total_days = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT date FROM attendance WHERE student_id='{$st['id']}' AND MONTH(date)='$month' AND YEAR(date)='$year'"));
            $present = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM attendance WHERE student_id='{$st['id']}' AND status='present' AND MONTH(date)='$month' AND YEAR(date)='$year'"));
            $absent = $total_days - $present;
        ?>
        <tr class="text-center border-b">
            <td class="px-4 py-2"><?= $st['roll_no'] ?></td>
            <td class="px-4 py-2"><?= $st['name'] ?></td>
            <td class="px-4 py-2"><?= $st['class_name'] ?></td>
            <td class="px-4 py-2"><?= $present ?></td>
            <td class="px-4 py-2"><?= $absent ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>

</div>
</body>
</html>
