<?php
session_start();
include 'config.php';
$error = "";

if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); 

  
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && $password === $user['password']){
        
        $_SESSION['username'] = $user['fullname'];
        header("Location: dashboard.php"); 
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Student Portal</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    
 <h1 class="login-title">STUDENT PORTAL</h1>


<div class="login-box">
    <h2>Login</h2>
    <?php if($error) echo "<div class='text-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="input-box">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <button type="submit" name="login" class="btn btn-success btn-submit">Login</button>
    </form>
    <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register</a></p>
</div>
</body> 


