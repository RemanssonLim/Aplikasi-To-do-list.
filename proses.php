<?php

include 'koneksi.php';

if(isset($_POST['add_task'])){
    $task_name= $_POST['task_name'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];

    $sql = "INSERT INTO task(task_name, status, priority, due_date) VALUES ('$task_name', '$status', '$priority', '$due_date')";
    if($conn->query($sql) === TRUE){
        header('location:index.php');
    }else{
        die('koneksi gagal:') . $sql . $conn->error;
    }
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $sql = "DELETE FROM task where id = $id";
    if($conn->query($sql) === TRUE){
        header('location:index.php');
    }else{
        die('koneksi gagal:') . $sql . $conn->error;
    }
}

?>