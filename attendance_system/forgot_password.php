<?php
session_start();
include "db.php";
require_once "send_mail.php";

$message = "";

if(isset($_POST['send_reset'])){
    $role = $_POST['role'];
    $email = trim($_POST['email']);

    if($role == "student"){
        $table = "students";
        $field = "email";
    } elseif($role == "teacher"){
        $table = "teachers";
        $field = "email";
    } else {
        $message = "Invalid role selected!";
    }

    if($message == ""){
        $user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM $table WHERE $field='$email'"));
        if($user){
            $token = bin2hex(random_bytes(16)); // unique token
            $expiry = date("Y-m-d H:i:s", strtotime("+30 minutes"));

            // Save token in DB (add column 'reset_token', 'token_expiry' in students/teachers table)
            mysqli_query($conn,"UPDATE $table SET reset_token='$token', token_expiry='$expiry' WHERE $field='$email'");

            $link = "http://localhost/attendance_system/reset_password.php?role=$role&token=$token";
            $subject = "Reset Your Password";
            $body = "Click the link below to reset your password:<br><a href='$link'>$link</a><br>This link expires in 30 minutes.";

            if(sendMail($email, $subject, $body)){
                $message = "Reset password link sent to your email!";
            } else {
                $message = "Failed to send email. Check your server settings.";
            }
        } else {
            $message = "Email not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Forgot Password</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-10 rounded shadow-md w-96">
    <h1 class="text-2xl font-bold mb-6 text-center">Forgot Password</h1>

    <?php if($message != ""){ echo "<p class='text-red-500 mb-4 text-center'>$message</p>"; } ?>

    <form method="POST">
        <select name="role" class="w-full p-2 border mb-4 rounded" required>
            <option value="">Select Role</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>

        <input type="email" name="email" placeholder="Enter your registered email" class="w-full p-2 border mb-4 rounded" required>
        <button type="submit" name="send_reset" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Send Reset Link</button>
    </form>

    <a href="index.php" class="block text-center mt-4 text-sm text-gray-600 hover:underline">
        ← Back to Login
    </a>
</div>

</body>
</html>
