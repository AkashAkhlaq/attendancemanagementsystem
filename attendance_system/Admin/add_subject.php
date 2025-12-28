<?php
include "../db.php";
$msg="";

if(isset($_POST['add_subject'])){
    $subject_name = trim($_POST['subject_name']);

    if($subject_name!=""){
        mysqli_query($conn,"INSERT INTO subjects (subject_name) VALUES ('$subject_name')");
        header("Location: subjects.php");
        exit();
    } else {
        $msg="Subject name is required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Subject</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">

<h2 class="text-2xl font-bold mb-4 text-center">Add Subject</h2>

<?php if($msg){ ?>
<p class="text-red-600 mb-3 text-center"><?= $msg ?></p>
<?php } ?>

<form method="post">
    <label class="block mb-2 font-medium">Subject Name</label>
    <input type="text" name="subject_name"
           class="w-full border px-3 py-2 rounded mb-4 focus:ring-2 focus:ring-blue-500">

    <div class="flex justify-between">
        <a href="subjects.php"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
           Back
        </a>

        <button name="add_subject"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Add
        </button>
    </div>
</form>

</div>
</body>
</html>
