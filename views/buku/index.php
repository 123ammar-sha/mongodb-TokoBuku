<?php include 'views/layouts/header.php'; ?>
<?php include 'views/layouts/sidebar.php'; ?>

<div class="content mt-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-dark mb-1">Kelola Daftar Buku</h2>
            <p class="text-muted small mb-0">Kelola dan atur seluruh katalog buku toko Anda.</p>
        </div>

        <a href="index.php?action=tambah" class="btn btn-primary shadow-sm px-4 rounded-pill fw-bold">
            <i class="bi bi-plus-lg me-1"></i> Tambah Buku Baru
        </a>
    </div>

    <!-- Metric Stats Cards -->
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card border-0 bg-primary-subtle text-primary shadow-sm rounded-3">
                <div class="card-body p-3.5">
                    <h6 class="text-uppercase fw-bold mb-1 opacity-75" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        <?= !empty($search) ? 'Hasil Filter Buku' : 'Total Koleksi Buku' ?>
                    </h6>
                    <h2 class="fw-extrabold mb-0"><?= $totalBukuHasil ?> <span class="fs-6 fw-normal text-secondary">Eks</span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 bg-success-subtle text-success shadow-sm rounded-3">
                <div class="card-body p-3.5">
                    <h6 class="text-uppercase fw-bold mb-1 opacity-75" style="font-size: 0.75rem; letter-spacing: 0.5px;">Genre Terkait</h6>
                    <h2 class="fw-extrabold mb-0"><?= $totalGenreHasil ?> <span class="fs-6 fw-normal text-secondary">Kategori</span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 bg-warning-subtle text-warning-emphasis shadow-sm rounded-3">
                <div class="card-body p-3.5">
                    <h6 class="text-uppercase fw-bold mb-1 opacity-75" style="font-size: 0.75rem; letter-spacing: 0.5px;">Penulis Terkait</h6>
                    <h2 class="fw-extrabold mb-0"><?= $totalPenulisHasil ?> <span class="fs-6 fw-normal text-secondary">Orang</span></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form Bar -->
    <div class="card border-0 shadow-sm rounded-3 p-3 mb-4 bg-white">
        <form method="GET" action="index.php" class="row g-2 align-items-center">
            <input type="hidden" name="action" value="index">
            <div class="col-md-8 col-lg-9">
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Cari judul, penulis, genre, atau penerbit..." value="<?= htmlspecialchars($search) ?>">
                </div>
            </div>
            <div class="col-md-4 col-lg-3 d-flex gap-2">
                <button class="btn btn-primary w-100 fw-semibold" type="submit">
                    Cari Buku
                </button>
                <?php if (!empty($search)): ?>
                    <a href="index.php?action=index" class="btn btn-outline-secondary d-flex align-items-center gap-1" title="Reset Pencarian">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <?php if (!empty($data)): ?>
        <!-- Books Cards Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-4">
            <?php foreach ($data as $buku): ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden position-relative card-buku">

                        <span class="badge bg-dark bg-opacity-75 position-absolute top-0 start-0 m-3 px-2.5 py-1.5 fs-7 shadow-sm" style="z-index: 2; border-radius: 6px;">
                            <?= htmlspecialchars($buku['genre'] ?? 'Umum') ?>
                        </span>

                        <div class="position-relative overflow-hidden bg-light border-bottom" style="height: 240px;">
                            <img src="uploads/<?= $buku['cover'] ?? 'default.png' ?>"
                                class="w-100 h-100 p-2"
                                alt="Cover Buku"
                                style="object-fit: contain; transition: transform 0.3s ease;">
                        </div>

                        <div class="card-body p-3 d-flex flex-column">
                            <h6 class="card-title fw-bold text-dark mb-1 text-truncate" title="<?= htmlspecialchars($buku['judul']) ?>" style="line-height: 1.4;">
                                <?= htmlspecialchars($buku['judul']) ?>
                            </h6>
                            <p class="card-text text-muted small mb-2 text-truncate">
                                By <?= htmlspecialchars($buku['penulis']) ?>
                            </p>

                            <?php if (!empty($buku['sinopsis'])): ?>
                                <p class="text-secondary small mb-3 opacity-75" style="font-size: 0.78rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.3em;">
                                    <?= htmlspecialchars($buku['sinopsis']) ?>
                                </p>
                            <?php else: ?>
                                <p class="text-muted small mb-3 fst-italic opacity-50" style="font-size: 0.78rem; height: 2.3em;">Tidak ada sinopsis.</p>
                            <?php endif; ?>

                            <div class="mt-auto pt-2 border-top border-light-subtle">
                                <?php if (!empty($buku['harga'])): ?>

                                    <?php if (!empty($buku['diskon']) && $buku['diskon'] > 0): ?>
                                        <?php $finalPrice = $buku['harga'] - ($buku['harga'] * $buku['diskon'] / 100); ?>
                                        <div class="d-flex align-items-center gap-1.5 mb-0.5">
                                            <span class="badge bg-danger-subtle text-danger fw-bold px-1.5 py-0.5" style="font-size: 0.7rem; border-radius: 4px;">
                                                <?= $buku['diskon'] ?>%
                                            </span>
                                            <del class="text-muted small style-strike" style="font-size: 0.8rem;">
                                                Rp <?= number_format($buku['harga'], 0, ',', '.') ?>
                                            </del>
                                        </div>
                                        <h5 class="fw-bold text-success mb-2">
                                            Rp <?= number_format($finalPrice, 0, ',', '.') ?>
                                        </h5>
                                    <?php else: ?>
                                        <h5 class="fw-bold text-primary mb-2">
                                            Rp <?= number_format($buku['harga'], 0, ',', '.') ?>
                                        </h5>
                                    <?php endif; ?>

                                <?php else: ?>
                                    <h5 class="fw-bold text-secondary mb-2 opacity-50" style="font-size: 0.95rem; font-style: italic;">
                                        Belum Ada Harga
                                    </h5>
                                <?php endif; ?>

                                <?php if (isset($buku['stok'])): ?>
                                    <div class="d-flex justify-content-between align-items-center small bg-light p-2 rounded-2" style="font-size: 0.78rem;">
                                        <span class="text-secondary">Stok:</span>
                                        <span class="fw-bold <?= $buku['stok'] > 0 ? 'text-success' : 'text-danger' ?>">
                                            <?= $buku['stok'] > 0 ? $buku['stok'] . ' Unit' : 'Habis' ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
                            <div class="row g-1">
                                <div class="col-4">
                                    <a href="index.php?action=detail&id=<?= $buku['_id'] ?>" class="btn btn-outline-info btn-sm w-100 py-1.5 fw-medium" style="font-size: 0.78rem;">Detail</a>
                                </div>
                                <div class="col-4">
                                    <a href="index.php?action=edit&id=<?= $buku['_id'] ?>" class="btn btn-outline-warning btn-sm w-100 py-1.5 fw-medium" style="font-size: 0.78rem;">Edit</a>
                                </div>
                                <div class="col-4">
                                    <a href="#" class="btn btn-outline-danger btn-sm w-100 py-1.5 fw-medium btn-delete" data-id="<?= $buku['_id'] ?>" style="font-size: 0.78rem;">Hapus</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Sleek Windowed Pagination & Metadata Summary -->
        <div class="card border-0 shadow-sm rounded-3 p-3 my-4 bg-white">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div class="text-muted small">
                    Menampilkan <span class="fw-bold text-dark"><?= count($data) ?></span> dari <span class="fw-bold text-dark"><?= $totalItems ?></span> buku
                    (Halaman <span class="fw-bold text-primary"><?= $page ?></span> dari <?= $totalPages ?>)
                </div>

                <?php if ($totalPages > 1): ?>
                    <?php
                    $range = 2;
                    $startPage = max(1, $page - $range);
                    $endPage = min($totalPages, $page + $range);
                    ?>
                    <nav aria-label="Navigasi Halaman">
                        <ul class="pagination pagination-sm mb-0 rounded-pill overflow-hidden border">
                            <!-- First Page & Prev -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link border-0 px-2.5" href="index.php?action=index&page=1&search=<?= urlencode($search) ?>" title="Halaman Pertama">
                                    <i class="bi bi-chevron-double-left"></i>
                                </a>
                            </li>
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link border-0 px-3" href="index.php?action=index&page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">
                                    Prev
                                </a>
                            </li>

                            <!-- Start Ellipsis -->
                            <?php if ($startPage > 1): ?>
                                <li class="page-item"><a class="page-link border-0 px-3" href="index.php?action=index&page=1&search=<?= urlencode($search) ?>">1</a></li>
                                <?php if ($startPage > 2): ?>
                                    <li class="page-item disabled"><span class="page-link border-0 px-2">...</span></li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <!-- Window Range Numbers -->
                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link border-0 px-3 fw-semibold" href="index.php?action=index&page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- End Ellipsis -->
                            <?php if ($endPage < $totalPages): ?>
                                <?php if ($endPage < $totalPages - 1): ?>
                                    <li class="page-item disabled"><span class="page-link border-0 px-2">...</span></li>
                                <?php endif; ?>
                                <li class="page-item"><a class="page-link border-0 px-3" href="index.php?action=index&page=<?= $totalPages ?>&search=<?= urlencode($search) ?>"><?= $totalPages ?></a></li>
                            <?php endif; ?>

                            <!-- Next & Last Page -->
                            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link border-0 px-3" href="index.php?action=index&page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">
                                    Next
                                </a>
                            </li>
                            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link border-0 px-2.5" href="index.php?action=index&page=<?= $totalPages ?>&search=<?= urlencode($search) ?>" title="Halaman Terakhir">
                                    <i class="bi bi-chevron-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>

    <?php else: ?>
        <div class="text-center py-5 border-0 rounded-3 bg-white shadow-sm my-4">
            <i class="bi bi-search text-muted fs-1 mb-2 d-block"></i>
            <h5 class="text-muted fw-bold mb-1">Buku Tidak Ditemukan.</h5>
            <?php if (!empty($search)): ?>
                <p class="text-muted small mb-3">Tidak ada hasil untuk pencarian kata kunci "<?= htmlspecialchars($search) ?>"</p>
                <a href="index.php?action=index" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Pencarian
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    .card-buku {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .card-buku:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .08) !important;
    }

    .card-buku:hover img {
        transform: scale(1.04);
    }

    .fw-extrabold {
        font-weight: 800;
    }

    .p-3\.5 {
        padding: 0.85rem 1rem;
    }

    .gap-1\.5 {
        gap: 0.35rem;
    }

    .px-2\.5 {
        padding-left: 0.6rem !important;
        padding-right: 0.6rem !important;
    }
</style>

<script>
    document.querySelectorAll(".btn-delete").forEach(button => {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            const id = this.dataset.id;

            Swal.fire({
                title: 'Hapus Buku?',
                text: "Data tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'index.php?action=delete&id=' + id;
                }
            });
        });
    });
</script>

<?php if (isset($_GET['success'])): ?>
    <script>
        <?php if ($_GET['success'] == "tambah"): ?>
            Swal.fire('Berhasil!', 'Buku berhasil ditambahkan', 'success');
        <?php elseif ($_GET['success'] == "edit"): ?>
            Swal.fire('Berhasil!', 'Buku berhasil diperbarui', 'success');
        <?php elseif ($_GET['success'] == "hapus"): ?>
            Swal.fire('Berhasil!', 'Buku berhasil dihapus', 'success');
        <?php endif; ?>
    </script>
<?php endif; ?>

</body>

</html>