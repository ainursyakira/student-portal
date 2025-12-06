<?php
session_start();
include 'config.php';

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$courses = [
    ["code" => "ICM572", "name" => "Gamification for Content Management", "credit" => 3],
    ["code" => "IMS560", "name" => "Advanced Database Management System", "credit" => 3],
    ["code" => "IMS564", "name" => "User Experience Design", "credit" => 2],
    ["code" => "IMS565", "name" => "Information System Project Management", "credit" => 3],
    ["code" => "IMSS566", "name" => "Advanced Web Design Development and Content Management", "credit" => 3],
    ["code" => "LCC501", "name" => "English for Professional Correspondence", "credit" => 2],
    ["code" => "TAC501", "name" => "Introductory Arabic (Level III)", "credit" => 2]
];

?>

<?php
$tasks = isset($_SESSION['tasks']) ? $_SESSION['tasks'] : [];
$completed = 0;
$pending = 0;

foreach ($tasks as $t) {
    if ($t['status'] === "Completed") $completed++;
    else $pending++;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Student Portal</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'navbar.php'; ?>
<div class="dashboard-greeting text-center mt-4">
    <h1 class="welcome-title">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p class="welcome-subtitle">Your learning journey starts here ✨</p>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">     
        <div class="col-md-4">
            <div class="announcements p-3 mb-4">
                <h5 class="mb-3">Announcements</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">IMS560 Assignment due next week.</li>
                    <li class="list-group-item">Note Chapter 2 uploaded in IMS564.</li>
                    <li class="list-group-item">LCC501: Tick your attendance.</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5 class="text-center">Task Status Overview</h5>
                <canvas id="taskChart"></canvas>
            </div>
        </div>

    </div>
</div>

<h3 class="mt-4 text-center">
    <span class="section-title">Courses You Are Enrolled In</span>
</h3>

<div class="table-container text-center">
    <div class="table-responsive d-flex justify-content-center">
        <table class="table table-striped table-bordered mt-2" style="width: 70%;">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Credit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($courses as $i => $course): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo htmlspecialchars($course['code']); ?></td>
                    <td><?php echo htmlspecialchars($course['name']); ?></td>
                    <td><?php echo htmlspecialchars($course['credit']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <img src="img/schedule.jpg" alt="Dashboard" class="dashboard-img mt-3">
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('taskChart').getContext('2d');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Completed', 'Pending'],
        datasets: [{
            data: [<?php echo $completed; ?>, <?php echo $pending; ?>],
            backgroundColor: ['#4CAF50', '#F44336'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});
</script>

</body>
</html>






