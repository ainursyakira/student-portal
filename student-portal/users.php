<?php
session_start();
include 'config.php'; 

if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}

$sql = "SELECT id, fullname, email FROM users ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Users - Student Portal</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <h2 class="text-center mb-3">Registered Students</h2>

    <div class="table-responsive small-table">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Full Name</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody>
            <?php if($result && $result->num_rows > 0): ?>
                <?php $no = 1; ?>
                <?php while($user = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

