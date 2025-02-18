<?php
include 'koneksi.php';

$sql = "SELECT * from task order by FIELD(Priority, 'Tinggi', 'Sedang', 'Rendah'), due_date ASC";
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>to do list</h1>
    <div class="container">
        <form action="proses.php" method="post">
        <input type="text" name="task name" placeholder="Nama tugas" required>
        <select name="status" required>
            <option value="Belum Selesai">Belum Selesai</option>
            <option value="Selesai">Selesai</option>
        </select>
        <select name="priority" required>
            <option value="Tinggi">Tinggi</option>
            <option value="Sedang">Sedang</option>
            <option value="Rendah">Rendah</option>
        </select>
        <input type="date" name="due_date" required>
        <button type="submit" name="add_task">Tambah Tugas</button>
        </form>
      <h2>Tabel To Do List</h2>
      <table >
      <th>Nama Tugas</th>
      <th>Status</th>
      <th>Priority</th>
      <th>Tanggal</th>
      <th>Aksi</th>
  

      <?php foreach($result as $row): ?>
        <tr>
        <td><?= $row['task_name'];?></td>
        <td><?= $row['status'];?></td>
        <td><?= $row['priority'];?></td>
        <td><?= $row['due_date'];?></td>
        <td>
            <button><a href="edit.php?id=<?=$row['id']; ?>">edit</a></button>
            <button><a href="proses.php?delete=<?=$row['id']; ?>" onclick="return confirm('apakah anda yakin ingin menghapus ini');">hapus</a></button>
        </td>

        <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
