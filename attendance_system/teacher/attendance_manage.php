<?php
session_start();
include "../db.php";

// Check if teacher is logged in
if(!isset($_SESSION['teacher'])){
    header("Location: login.php");
    exit();
}

$teacher_id = $_SESSION['teacher'];

// Fetch teacher assigned courses
$courses = mysqli_query($conn, "SELECT * FROM courses WHERE teacher_id='$teacher_id'");

$course_id = $_GET['course_id'] ?? 0;

// If a course is selected
if($course_id){
    $course_query = mysqli_query($conn, "SELECT * FROM courses WHERE id='$course_id' AND teacher_id='$teacher_id'");
    if(mysqli_num_rows($course_query) == 0){
        die("<p class='text-red-600 font-bold'>Invalid Course or Access Denied!</p>");
    }
    $course = mysqli_fetch_assoc($course_query);

    // Fetch students of this class
    $students = mysqli_query($conn, "SELECT * FROM students WHERE class_id='{$course['class_id']}'");

    // Save attendance
    if(isset($_POST['save'])){
        foreach($_POST['status'] as $student_id => $status){
            $date = date("Y-m-d");
            $check = mysqli_query($conn, "SELECT * FROM attendance WHERE student_id='$student_id' AND course_id='$course_id' AND date='$date'");
            if(mysqli_num_rows($check) > 0){
                mysqli_query($conn, "UPDATE attendance SET status='$status' WHERE student_id='$student_id' AND course_id='$course_id' AND date='$date'");
            } else {
                mysqli_query($conn, "INSERT INTO attendance (student_id, course_id, date, status) VALUES ('$student_id', '$course_id', '$date', '$status')");
            }
        }
        $msg = "Attendance saved successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Attendance</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<a href="dashboard.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to Dashboard</a>

<h1 class="text-2xl font-bold mt-4 mb-4">Teacher Attendance Management</h1>

<!-- Select Course -->
<div class="mb-6">
    <form method="GET">
        <label for="course_id" class="font-bold mr-2">Select Course:</label>
        <select name="course_id" onchange="this.form.submit()" class="border rounded p-1">
            <option value="">--Choose Course--</option>
            <?php while($c = mysqli_fetch_assoc($courses)): ?>
                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $course_id)?'selected':'' ?>>
                    <?= $c['course_name'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>
</div>

<?php if(isset($course) && $course_id): ?>
    <h2 class="text-xl font-bold mb-4">Manage Attendance for <?= $course['course_name'] ?></h2>
    <?php if(isset($msg)) echo "<p class='text-green-600 mb-4'>$msg</p>"; ?>

    <form method="POST">
        <table class="min-w-full bg-white rounded shadow-md">
            <tr class="bg-gray-200">
                <th class="p-2">Roll No</th>
                <th class="p-2">Student Name</th>
                <th class="p-2">Status</th>
            </tr>
            <?php while($student = mysqli_fetch_assoc($students)):
                $att = mysqli_fetch_assoc(mysqli_query($conn, "SELECT status FROM attendance WHERE student_id='{$student['id']}' AND course_id='$course_id' AND date='".date("Y-m-d")."'"));
                $status = $att['status'] ?? '';
            ?>
            <tr>
                <td class="p-2"><?= $student['roll_no'] ?></td>
                <td class="p-2"><?= $student['name'] ?></td>
                <td class="p-2">
                    <select name="status[<?= $student['id'] ?>]" class="border rounded p-1">
                        <option value="Present" <?= ($status=='Present')?'selected':'' ?>>Present</option>
                        <option value="Absent" <?= ($status=='Absent')?'selected':'' ?>>Absent</option>
                    </select>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <button type="submit" name="save" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Attendance</button>
    </form>
<?php endif; ?>

</body>
</html>
