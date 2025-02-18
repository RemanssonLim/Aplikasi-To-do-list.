<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM task where id=?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("i",$id);
    $stm->execute();
    $result = $stm->get_result();
    $task = $result->fetch_assoc();
}

if(isset($_POST['submit'])) {
    $task_name = $_POST['task_name'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];

    $sql = "UPDATE task SET task_name=?, status=?, priority=?, due_date=? WHERE id=?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("ssssi", $task_name, $status, $priority, $due_date, $id);
    if ($stm->execute()) {
        echo'Task Updated Succesfully!!';
        header("location:index.php");
    } else {
        echo "Error updating task: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="style2ss.css">
</head>
<body>
    <div class="container">
        <h2 class="betul betul">Edit Task</h2>
    
        <form action="edit.php?id=<?= $task['id']; ?>" method="POST">
        <div class="form-group">
            <label for="task name">Task Name</label>
            <input type="text"  id="task name" name="task name" value="<?php echo $task['task_name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                 <option value="Belum Selesai" <?php if ($task['status'] == "Belum Selesai") echo 'selected' ; ?>>Belum Selesai</option>
                 <option value="Selesai" <?php if ($task['status'] == "Selesai") echo 'selected' ; ?>>Selesai</option>
            </select>
        </div>

<div class="form-group">
    <label for="priority">Priority</label>
    <select name="priority" id="priority" required>
        <option value="Rendah" <?php if ($task['priority'] == 'Rendah') echo 'selected' ;?>>Rendah</option>
        <option value="Sedang" <?php if ($task['priority'] == 'Sedang') echo 'selected' ;?>>Sedang</option>
        <option value="Tinggi" <?php if ($task['priority'] == 'Tinggi') echo 'selected' ;?>>Tinggi</option>
    </select>
</div>

   <div class="form-group">
    <label for="due date">Due Date</label>
    <input type="date" name="due date" id="due date" value="<?php echo $task['due_date']; ?>" required>
   </div>

       <button type="submit" name="submit" class="btn">Update Task</button>
        </form>
    </div>
    
</body>
</html>

<?php
$conn->close();
?>