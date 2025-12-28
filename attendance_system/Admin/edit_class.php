<?php
include "../db.php";

$id = $_GET['id'] ?? 0;

$class = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM classes WHERE id='$id'")
);

if(!$class){
    header("Location: classes.php");
    exit();
}

if(isset($_POST['update_class'])){
    $class_name = trim($_POST['class_name']);
    if($class_name != ""){
        mysqli_query($conn,"UPDATE classes SET class_name='$class_name' WHERE id='$id'");
        header("Location: classes.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Class</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-center">Edit Class</h2>

    <form method="post">
        <label class="block mb-2 font-medium">Class Name</label>
        <input type="text" name="class_name"
               value="<?= htmlspecialchars($class['class_name']) ?>"
               class="w-full border px-3 py-2 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <div class="flex justify-between">
            <a href="classes.php"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
               Back
            </a>

            <button name="update_class"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Update
            </button>
        </div>
    </form>
</div>

</body>
</html>
