<?php
session_start();
include 'config.php';

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if(!isset($_SESSION['tasks'])){
    $_SESSION['tasks'] = [
        ["id"=>1,"task"=>"LCC501 Email Exercise","status"=>"Completed","file"=>""],
        ["id"=>2,"task"=>"TAC501 Roleplay Script","status"=>"Completed","file"=>""],
        ["id"=>3,"task"=>"IMS566 Individual Assignment","status"=>"Completed","file"=>""],
        ["id"=>4,"task"=>"IMS560 Individual Assignment","status"=>"Pending","file"=>""],
        ["id"=>5,"task"=>"ICM572 Computer Lab Exercise","status"=>"Pending","file"=>""]
    ];
}

if(isset($_POST['add_task'])){
    $newTask = trim($_POST['task']);
    $newId = count($_SESSION['tasks']) > 0 ? end($_SESSION['tasks'])['id'] + 1 : 1;
    $_SESSION['tasks'][] = [
        "id"=>$newId,
        "task"=>$newTask,
        "status"=>"Pending",
        "file"=>""
    ];
}

if(isset($_POST['submit_task']) && isset($_FILES['pdf_file'])){
    $task_id = $_POST['task_id'];
    $file = $_FILES['pdf_file'];

    $upload_dir = "uploads/";
    if(!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $filename = $file['name'];
    $target_file = $upload_dir . basename($filename);

    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($fileType == "pdf"){
        if(move_uploaded_file($file['tmp_name'], $target_file)){
            foreach($_SESSION['tasks'] as &$t){
                if($t['id'] == $task_id){
                    $t['status'] = "Completed";
                    $t['file'] = $target_file;
                    break;
                }
            }
        } else {
            $error = "Failed to upload file.";
        }
    } else {
        $error = "Only PDF files are allowed.";
    }
}

$tasks = $_SESSION['tasks'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tasks - Student Portal</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<style>
.text-red { color: red; font-weight: bold; }
</style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <h3 class="text-center mb-4">Tasks List</h3>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($tasks as $i => $task): ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo htmlspecialchars($task['task']); ?></td>
                    <td>
                        <?php echo $task['status'] == "Pending" ? '<span class="text-red">Not Submit Yet</span>' : '<span class="text-success">Submitted</span>'; ?>
                    </td>
                    <td>
                        <?php if($task['status']=="Pending"): ?>
                            <form method="POST" enctype="multipart/form-data" style="display:flex; gap:5px;">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <input type="file" name="pdf_file" accept="application/pdf" required>
                                <button type="submit" name="submit_task" class="btn btn-primary btn-sm">Submit</button>
                            </form>
                        <?php elseif(!empty($task['file'])): ?>
                            <a href="<?php echo $task['file']; ?>" target="_blank" class="btn btn-success btn-sm">View PDF</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    
<img src="img/teacher.jpg" alt="Tasks" class="tasks-img">

</div>

</body>
</html>

