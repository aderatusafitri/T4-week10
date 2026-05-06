<?php
require_once 'config/database.php';
$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun = trim($_POST['tahun_terbit'] ?? '');
    $stok = trim($_POST['stok'] ?? '0');

    if (!empty($judul) && !empty($pengarang) && !empty($tahun)) {
        $stmt = $pdo->prepare("INSERT INTO buku (judul, pengarang, tahun_terbit, stok) 
                               VALUES (:judul, :pengarang, :tahun, :stok)");
        $stmt->execute([
            ':judul' => $judul,
            ':pengarang' => $pengarang,
            ':tahun' => $tahun,
            ':stok' => $stok
        ]);

        header("Location: index.php?pesan=tambah_sukses");
        exit;
    } else {
        $pesan = "Semua field wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
    <h2>Tambah Buku</h2>

    <?php if ($pesan): ?>
        <div class="alert alert-danger"><?= $pesan ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pengarang</label>
            <input type="text" name="pengarang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="0">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>