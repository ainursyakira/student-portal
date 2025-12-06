<?php
include 'config.php';

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$profileData = [
    "fullname" => "Wan Ainur Syakirah Binti Wan Muliadi",
    "idnumber" => "2024963309",
    "ic" => "020912-11-0164",
    "dob" => "12 September 2002",
    "email" => "ainursyakirah1@gmail.com",
    "phone" => "016 - 8448929",
    "course" => "CDIM262",
    "group" => "4A"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile - Student Portal</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'navbar.php'; ?>   

<div class="container mt-5 text-center">
    <h2>My Profile</h2>

    <img src="img/syakira.jpg" alt="Profile Picture" class="profile-img">

    <table class="table table-bordered mt-3 profile-table">
        <tr><th>Fullname</th><td><?php echo htmlspecialchars($profileData['fullname']); ?></td></tr>
        <tr><th>ID Number</th><td><?php echo htmlspecialchars($profileData['idnumber']); ?></td></tr>
        <tr><th>IC</th><td><?php echo htmlspecialchars($profileData['ic']); ?></td></tr>
        <tr><th>Date of Birth</th><td><?php echo htmlspecialchars($profileData['dob']); ?></td></tr>
        <tr><th>Email</th><td><?php echo htmlspecialchars($profileData['email']); ?></td></tr>
        <tr><th>Phone</th><td><?php echo htmlspecialchars($profileData['phone']); ?></td></tr>
        <tr><th>Course</th><td><?php echo htmlspecialchars($profileData['course']); ?></td></tr>
        <tr><th>Group</th><td><?php echo htmlspecialchars($profileData['group']); ?></td></tr>
    </table>

</div>

</body>
</html>





