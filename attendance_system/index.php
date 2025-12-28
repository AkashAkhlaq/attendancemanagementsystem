<?php
session_start();
include "db.php";

$message = "";

if(isset($_POST['login'])){
    $role = $_POST['role'];
    $user = trim($_POST['email_or_roll']);
    $pass = trim($_POST['password']);

    if($role == "admin"){
        $table="admin"; $field="email";
    } elseif($role=="teacher"){
        $table="teachers"; $field="email";
    } elseif($role=="student"){
        $table="students"; $field="roll_no";
    } else {
        $message="Select role!";
    }

    if($message==""){
        $q=mysqli_query($conn,"SELECT * FROM $table WHERE $field='$user'");
        if(mysqli_num_rows($q)==1){
            $row=mysqli_fetch_assoc($q);

            // STUDENT PASSWORD SIMPLE (NOT HASH)
            if($pass == $row['password']){
                if($role=="admin"){ $_SESSION['admin']=$row['id']; header("Location: admin/dashboard.php"); }
                if($role=="teacher"){ $_SESSION['teacher']=$row['id']; header("Location: teacher/dashboard.php"); }
                if($role=="student"){ $_SESSION['student']=$row['roll_no']; header("Location: student/dashboard.php"); }
                exit();
            } else {
                $message="Invalid password!";
            }
        } else {
            $message="User not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login | Attendance System</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-500 to-blue-600 flex items-center justify-center h-screen">

<div class="bg-white w-96 p-8 rounded-xl shadow-xl">

<h2 class="text-2xl font-bold text-center mb-6">Attendance System Login</h2>

<?php if($message){ ?>
<p class="text-red-600 text-center mb-3"><?= $message ?></p>
<?php } ?>

<form method="post">

<select name="role" class="w-full border p-2 mb-3 rounded" required>
<option value="">Select Role</option>
<option value="admin">Admin</option>
<option value="teacher">Teacher</option>
<option value="student">Student</option>
</select>

<input type="text" name="email_or_roll"
placeholder="Email or Roll No"
class="w-full border p-2 mb-3 rounded" required>

<input type="password" name="password"
placeholder="Password"
class="w-full border p-2 mb-3 rounded" required>

<button name="login"
class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700">
Login
</button>

</form>

<!-- 🔐 FORGOT PASSWORD -->
<div class="text-center mt-4">
<a href="forgot_password.php"
class="text-sm text-blue-600 hover:underline">
Forgot Password?
</a>
</div>

</div>
</body>
</html>
