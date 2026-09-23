<?php include 'views/layouts/header.php'; ?>
<?php include 'views/layouts/sidebar.php'; ?>

<div class="content container mt-4">

    <div class="mb-3">
        <a href="index.php" class="text-decoration-none text-muted small fw-medium d-inline-flex align-items-center gap-1 hover-link">
            ← Kembali ke Daftar Buku
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-body p-4 p-md-5">
            <div class="row g-4 align-items-start">

                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <div class="position-relative d-inline-block bg-light p-2 rounded-3 shadow-sm border border-light-subtle">
                        <img src="uploads/<?= $buku['cover'] ?? 'default.png' ?>"
                            class="img-fluid rounded-2"
                            alt="Cover <?= htmlspecialchars($buku['judul']) ?>"
                            style="max-height: 420px; width: 100%; object-fit: cover; min-width: 240px;">
                    </div>
                </div>

                <div class="col-md-8">

                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                        <?= htmlspecialchars($buku['genre'] ?? 'Umum') ?>
                    </span>

                    <h2 class="fw-extrabold text-dark mb-1 text-uppercase" style="letter-spacing: -0.5px; line-height: 1.2;">
                        <?= htmlspecialchars($buku['judul']) ?>
                    </h2>

                    <p class="text-secondary fs-5 mb-4">
                        Ditulis oleh <span class="fw-semibold text-dark"><?= htmlspecialchars($buku['penulis']) ?></span>
                    </p>

                    <?php if (!empty($buku['sinopsis'])): ?>
                        <div class="p-3 bg-light rounded-3 mb-4 border border-light-subtle">
                            <h6 class="fw-bold text-uppercase text-primary mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">
                                <i class="bi bi-file-text me-1"></i> Sinopsis / Ringkasan Buku
                            </h6>
                            <p class="text-dark mb-0 fs-6 lh-base" style="white-space: pre-line;">
                                <?= htmlspecialchars($buku['sinopsis']) ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <hr class="border-light-subtle my-3">

                    <h6 class="fw-bold text-uppercase text-secondary mb-3" style="font-size: 0.75rem; letter-spacing: 1px;">Spesifikasi Buku</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-sm-4">
                            <small class="text-muted d-block mb-0.5">Penerbit</small>
                            <span class="fw-semibold text-dark-emphasis"><?= htmlspecialchars($buku['penerbit'] ?? '-') ?></span>
                        </div>
                        <div class="col-6 col-sm-4">
                            <small class="text-muted d-block mb-0.5">Tahun Terbit</small>
                            <span class="fw-semibold text-dark-emphasis"><?= htmlspecialchars($buku['tahun_terbit'] ?? '-') ?></span>
                        </div>
                        <div class="col-6 col-sm-4">
                            <small class="text-muted d-block mb-0.5">Jumlah Halaman</small>
                            <span class="fw-semibold text-dark-emphasis"><?= htmlspecialchars($buku['jumlah_halaman'] ?? '-') ?> Halaman</span>
                        </div>
                    </div>

                    <div class="card border-0 bg-light p-4 rounded-3 mb-4">
                        <div class="row align-items-center">
                            <div class="col-sm-7 mb-3 mb-sm-0">
                                <small class="text-muted d-block mb-1 fw-medium">Informasi Harga</small>

                                <?php if (!empty($buku['harga'])): ?>
                                    <?php if (!empty($buku['diskon']) && $buku['diskon'] > 0): ?>
                                        <?php $finalPrice = $buku['harga'] - ($buku['harga'] * $buku['diskon'] / 100); ?>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="badge bg-danger text-white fw-bold px-2 py-1" style="font-size: 0.75rem; border-radius: 4px;">
                                                DISKON <?= $buku['diskon'] ?>%
                                            </span>
                                            <del class="text-muted small">
                                                Rp <?= number_format($buku['harga'], 0, ',', '.') ?>
                                            </del>
                                        </div>
                                        <h3 class="fw-black text-success m-0">
                                            Rp <?= number_format($finalPrice, 0, ',', '.') ?>
                                        </h3>
                                    <?php else: ?>
                                        <h3 class="fw-black text-primary m-0">
                                            Rp <?= number_format($buku['harga'], 0, ',', '.') ?>
                                        </h3>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <h5 class="text-muted m-0 font-style-italic">Harga Belum Ditentukan</h5>
                                <?php endif; ?>
                            </div>

                            <div class="col-sm-5 border-start border-light-subtle ps-sm-4">
                                <small class="text-muted d-block mb-1 fw-medium">Status Ketersediaan</small>
                                <?php if (isset($buku['stok'])): ?>
                                    <h5 class="m-0 fw-bold <?= $buku['stok'] > 0 ? 'text-success' : 'text-danger' ?>">
                                        <?= $buku['stok'] > 0 ? '● Tersedia (' . $buku['stok'] . ' Unit)' : '✕ Stok Habis' ?>
                                    </h5>
                                <?php else: ?>
                                    <h5 class="m-0 fw-bold text-secondary">● Tanpa Batas Stok</h5>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="index.php?action=edit&id=<?= $buku['_id'] ?>" class="btn btn-warning px-4 text-white fw-medium">
                            Edit Data Buku
                        </a>
                        <a href="index.php?action=index" class="btn btn-outline-secondary px-4 fw-medium">
                            Kembali
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<style>
    .fw-extrabold {
        font-weight: 800;
    }

    .fw-black {
        font-weight: 900;
    }

    .hover-link {
        transition: color 0.2s;
    }

    .hover-link:hover {
        color: #0d6efd !important;
    }
</style>

<?php include 'views/layouts/footer.php'; ?>