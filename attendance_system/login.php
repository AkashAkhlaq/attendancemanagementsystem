<?php
session_start();
include "db.php";

if(!isset($_GET['role'])){
    die("Role not specified!");
}

$role = $_GET['role'];
$message = "";

if(isset($_POST['login'])){

    $username = trim($_POST['email_or_roll']);
    $password = trim($_POST['password']);

    if($role == "admin"){
        $table = "admin";
        $field = "email";
    }
    elseif($role == "teacher"){
        $table = "teachers";
        $field = "email";
    }
    elseif($role == "student"){
        $table = "students";
        $field = "roll_no";
    }
    else{
        die("Invalid role!");
    }

    $stmt = $conn->prepare(
        "SELECT * FROM $table WHERE $field = ? AND password = ?"
    );
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();

        if($role == "admin"){
            $_SESSION['admin'] = $user['id'];
            header("Location: admin/dashboard.php");
        }
        elseif($role == "teacher"){
            $_SESSION['teacher'] = $user['id'];
            header("Location: teacher/dashboard.php");
        }
        else{
            $_SESSION['student'] = $user['roll_no'];
            header("Location: student/dashboard.php");
        }
        exit();
    }

    $message = "Invalid credentials!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= ucfirst($role) ?> Login</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-600 to-blue-500 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-lg shadow-lg w-96">

<h2 class="text-2xl font-bold text-center mb-6 text-gray-700">
<?= ucfirst($role) ?> Login
</h2>

<?php if($message){ ?>
<p class="bg-red-100 text-red-600 p-2 rounded mb-4 text-center">
<?= $message ?>
</p>
<?php } ?>

<form method="POST">

<input type="text"
       name="email_or_roll"
       placeholder="<?= ($role=='student')?'Roll No':'Email' ?>"
       class="w-full border p-2 mb-4 rounded"
       required>

<input type="password"
       name="password"
       placeholder="Password"
       class="w-full border p-2 mb-4 rounded"
       required>

<button name="login"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
Login
</button>

</form>

<div class="flex justify-between text-sm mt-4">
<a href="index.php" class="text-gray-600 hover:underline">← Back</a>
<a href="forgot_password.php?role=<?= $role ?>" class="text-blue-600 hover:underline">
Forgot Password?
</a>
</div>

</div>

</body>
</html>
