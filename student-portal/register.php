<?php
include 'config.php';

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if(empty($fullname) || empty($email) || empty($password) || empty($confirm)){
        $error = "Sila lengkapkan semua field!";
    } elseif($password !== $confirm){
        $error = "Password dan Confirm Password tidak sama!";
    } else {

        $check = $conn->query("SELECT * FROM users WHERE email='$email'");
        if ($check->num_rows > 0) {
            $error = "Email sudah digunakan!";
        } else {
            $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
            if ($conn->query($sql)) {
                $success = "Pendaftaran berjaya! Sila login.";
                echo "<script>setTimeout(function(){ window.location='index.php'; }, 2000);</script>";
            } else {
                $error = "Ralat: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Student Portal</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

</head>
<body class="register-body">

<div class="register-box">
    <h2>Register</h2>

    <?php if($error) echo "<div class='text-danger'>$error</div>"; ?>
    <?php if($success) echo "<div class='text-success'>$success</div>"; ?>

    <form method="POST">
        <div class="input-box">
            <input type="text" name="fullname" placeholder="Fullname" required>
        </div>

        <div class="input-box">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="input-box">
            <input type="password" name="confirm" placeholder="Confirm Password" required>
        </div>

        <button type="submit" name="register" class="btn btn-primary btn-submit">Register</button>
    </form>

    <p class="mt-3 text-center">Already have an account?  
        <a href="index.php">Login</a>
    </p>
</div>

</body>
</html>






