<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logged Out - Student Portal</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<script>

setTimeout(function(){
    window.location.href = "index.php";
}, 2000);
</script>
</head>
<body>
<div class="logout-box">
    <h2>You have been logged out!</h2>
    <p>Redirecting to login page...</p>
    <a href="index.php">Login Again</a>
</div>
</body>
</html>
