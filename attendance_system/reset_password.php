<?php
session_start();
include "db.php";

$message = "";
$role = $_GET['role'] ?? "";
$token = $_GET['token'] ?? "";

if(!$role || !$token){
    die("Invalid link");
}

if(isset($_POST['reset_password'])){
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if($password !== $confirm){
        $message = "Passwords do not match!";
    } else {
        $table = ($role=="student")?"students":"teachers";
        $user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM $table WHERE reset_token='$token' AND token_expiry >= NOW()"));
        if($user){
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn,"UPDATE $table SET password='$hashed', reset_token=NULL, token_expiry=NULL WHERE id='{$user['id']}'");
            $message = "Password reset successfully! <a href='index.php'>Login Now</a>";
        } else {
            $message = "Invalid or expired token!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reset Password</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-10 rounded shadow-md w-96">
    <h1 class="text-2xl font-bold mb-6 text-center">Reset Password</h1>

    <?php if($message != ""){ echo "<p class='text-red-500 mb-4 text-center'>$message</p>"; } ?>

    <form method="POST">
        <input type="password" name="password" placeholder="New Password" class="w-full p-2 border mb-4 rounded" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" class="w-full p-2 border mb-4 rounded" required>
        <button type="submit" name="reset_password" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Reset Password</button>
    </form>
</div>

</body>
</html>
