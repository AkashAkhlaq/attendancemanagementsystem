<?php
include "../db.php";
$id = $_GET['id'] ?? 0;

$subject = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM subjects WHERE id='$id'")
);

if(!$subject){
    header("Location: subjects.php");
    exit();
}

if(isset($_POST['update_subject'])){
    $subject_name = trim($_POST['subject_name']);
    if($subject_name!=""){
        mysqli_query($conn,"UPDATE subjects SET subject_name='$subject_name' WHERE id='$id'");
        header("Location: subjects.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Subject</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">

<h2 class="text-2xl font-bold mb-4 text-center">Edit Subject</h2>

<form method="post">
    <label class="block mb-2 font-medium">Subject Name</label>
    <input type="text" name="subject_name"
           value="<?= htmlspecialchars($subject['subject_name']) ?>"
           class="w-full border px-3 py-2 rounded mb-4 focus:ring-2 focus:ring-green-500">

    <div class="flex justify-between">
        <a href="subjects.php"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
           Back
        </a>

        <button name="update_subject"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Update
        </button>
    </div>
</form>

</div>
</body>
</html>
