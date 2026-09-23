<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Katalog: <?= htmlspecialchars($buku['judul']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fa;
        }

        .fw-extrabold {
            font-weight: 800;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark" href="index.php">
                <i class="bi bi-journal-bookmark-fill text-primary me-2"></i>Katalog<span class="text-primary">Buku</span>
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="mb-4">
            <a href="index.php" class="btn btn-light rounded-pill px-3 btn-sm text-secondary fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog Utama
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
            <div class="row g-0">

                <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-4 border-end border-light-subtle">
                    <img src="uploads/<?= $buku['cover'] ?? 'default.png' ?>" class="img-fluid rounded-3 shadow" style="max-height: 400px; object-fit: contain;" alt="Cover Buku">
                </div>

                <div class="col-md-8 p-4 p-md-5">
                    <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-1.5 rounded-pill font-monospace text-uppercase">
                        <?= htmlspecialchars($buku['genre'] ?? 'Umum') ?>
                    </span>

                    <h2 class="fw-extrabold text-dark mb-1"><?= htmlspecialchars($buku['judul']) ?></h2>
                    <p class="text-muted fs-5 mb-4">Karya Utama: <span class="text-dark fw-semibold"><?= htmlspecialchars($buku['penulis']) ?></span></p>

                    <?php if (!empty($buku['sinopsis'])): ?>
                        <div class="p-3 bg-light rounded-3 mb-4 border border-light-subtle">
                            <h6 class="fw-bold text-uppercase text-primary mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">
                                <i class="bi bi-file-text me-1"></i> Sinopsis / Ringkasan Cerita
                            </h6>
                            <p class="text-dark mb-0 fs-6 lh-base" style="white-space: pre-line;">
                                <?= htmlspecialchars($buku['sinopsis']) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom"><i class="bi bi-info-circle me-2 text-primary"></i>Lembar Spesifikasi Arsip</h5>

                    <table class="table table-borderless align-middle text-secondary mb-0">
                        <tbody>
                            <tr>
                                <td width="35%" class="fw-semibold py-2">Penerbit Resmi</td>
                                <td width="5%" class="text-center">:</td>
                                <td width="60%" class="text-dark"><?= htmlspecialchars($buku['penerbit'] ?? '-') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold py-2">Tahun Terbit</td>
                                <td class="text-center">:</td>
                                <td class="text-dark"><?= $buku['tahun_terbit'] ?? '-' ?></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold py-2">Ketebalan Buku</td>
                                <td class="text-center">:</td>
                                <td class="text-dark"><?= $buku['jumlah_halaman'] ?? '-' ?> Halaman</td>
                            </tr>

                            <?php if (!empty($buku['harga'])): ?>
                                <tr>
                                    <td class="fw-semibold py-2">Nilai / Harga Katalog</td>
                                    <td class="text-center">:</td>
                                    <td class="text-success fw-bold">Rp <?= number_format($buku['harga'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if (isset($buku['stok']) && $buku['stok'] !== null): ?>
                                <tr>
                                    <td class="fw-semibold py-2">Ketersediaan Unit</td>
                                    <td class="text-center">:</td>
                                    <td class="text-dark"><?= $buku['stok'] ?> Eksemplar</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white border-top py-4 mt-5 text-center text-muted small">
        <div class="container">
            <p class="mb-0">© 2026 Sistem Katalog Digital. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>

</html>