<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "todolist";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
    die ('koneksi gagal') . $conn->connect_error;
}