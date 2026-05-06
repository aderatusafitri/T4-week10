<?php
require_once 'config/database.php';

$stmt = $pdo->query("SELECT * FROM buku ORDER BY id DESC");
$buku = $stmt->fetchAll();

$pesan = $_GET['pesan'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Data Buku</h2>

    <?php if ($pesan == 'tambah_sukses'): ?>
        <div class="alert alert-success">Data berhasil ditambahkan!</div>
    <?php elseif ($pesan == 'edit_sukses'): ?>
        <div class="alert alert-warning">Data berhasil diupdate!</div>
    <?php elseif ($pesan == 'hapus_sukses'): ?>
        <div class="alert alert-danger">Data berhasil dihapus!</div>
    <?php endif; ?>

    <a href="create.php" class="btn btn-primary mb-3">Tambah Buku</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($buku): ?>
                    <?php $no = 1; foreach ($buku as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['judul']) ?></td>
                            <td><?= htmlspecialchars($row['pengarang']) ?></td>
                            <td><?= $row['tahun_terbit'] ?></td>
                            <td><?= $row['stok'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?= $row['id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin mau hapus data ini?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>