<?php
include "../db.php";

$msg = "";

if(isset($_POST['add_class'])){
    $class_name = trim($_POST['class_name']);

    if($class_name != ""){
        mysqli_query($conn,"INSERT INTO classes (class_name) VALUES ('$class_name')");
        header("Location: classes.php");
        exit();
    } else {
        $msg = "Class name is required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Class</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-center">Add Class</h2>

    <?php if($msg){ ?>
        <p class="text-red-600 mb-3 text-center"><?= $msg ?></p>
    <?php } ?>

    <form method="post">
        <label class="block mb-2 font-medium">Class Name</label>
        <input type="text" name="class_name"
               class="w-full border px-3 py-2 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
               placeholder="Enter class name">

        <div class="flex justify-between">
            <a href="classes.php"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
               Back
            </a>

            <button name="add_class"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Add Class
            </button>
        </div>
    </form>
</div>

</body>
</html>
