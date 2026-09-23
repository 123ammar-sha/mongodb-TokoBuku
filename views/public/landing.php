<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Resmi TokoBuku Kita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9fbfd;
        }

        .hero-showcase {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            position: relative;
        }

        .card-katalog {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e2e8f0;
        }

        .card-katalog:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.05);
            border-color: #cbd5e1;
        }

        .img-container {
            height: 250px;
            background-color: #f8fafc;
            overflow: hidden;
        }

        .img-container img {
            transition: transform 0.5s ease;
        }

        .card-katalog:hover .img-container img {
            transform: scale(1.03);
        }

        .fw-extrabold {
            font-weight: 800;
        }

        .pagination .page-link {
            color: #475569;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .pagination .page-item.active .page-link {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
        }

        .pagination .page-item.disabled .page-link {
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-extrabold text-dark fs-4" href="index.php">
                <i class="bi bi-journal-bookmark-fill text-primary me-2"></i>Toko<span class="text-primary">Buku</span>
            </a>
            <div class="ms-auto">
                <a href="index.php?action=dashboard" class="btn btn-light btn-sm px-3 rounded-pill fw-medium text-secondary">
                    <i class="bi bi-shield-lock me-1"></i> Panel Admin
                </a>
            </div>
        </div>
    </nav>

    <header class="hero-showcase text-white py-5 text-center text-md-start">
        <div class="container py-3">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge bg-primary px-3 py-2 rounded-pill fw-semibold mb-3 small">
                        Daftar Koleksi Buku
                    </span>
                    <h1 class="display-5 fw-extrabold mb-3 text-white" style="letter-spacing: -1px;">
                        Toko Buku MongoDB
                    </h1>
                    <p class="lead text-white-50 fs-6 mb-0">
                        Project Akhir Mata Kuliah Teknologi Basis Data, TokoBuku berbasis Non-SQL
                    </p>
                </div>
                <div class="col-lg-5 text-md-end d-none d-lg-block">
                    <i class="bi bi-collection-play text-white opacity-10" style="font-size: 9rem;"></i>
                </div>
            </div>
        </div>
    </header>

    <main class="container my-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">Daftar Pustaka</h4>
                <p class="text-muted small mb-0">Gunakan kolom pencarian di bawah untuk mencari buku pilihan Anda.</p>
            </div>

            <form method="GET" action="index.php" class="w-100" style="max-width: 420px;">
                <input type="hidden" name="action" value="landing">
                <div class="input-group rounded-3 overflow-hidden bg-white border shadow-sm">
                    <span class="input-group-text bg-white border-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-0 ps-0" placeholder="Cari judul, penulis, genre..." value="<?= htmlspecialchars($search) ?>">
                    <button class="btn btn-primary px-3" type="submit">Cari</button>
                    <?php if (!empty($search)): ?>
                        <a href="index.php?action=landing" class="btn btn-outline-secondary d-flex align-items-center gap-1" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <?php if (!empty($data)): ?>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-4">
                <?php foreach ($data as $buku): ?>
                    <div class="col">
                        <div class="card h-100 bg-white rounded-3 overflow-hidden card-katalog">

                            <div class="position-relative img-container d-flex align-items-center justify-content-center p-3 border-bottom">
                                <img src="uploads/<?= $buku['cover'] ?? 'default.png' ?>" class="shadow-sm rounded-2 h-100" alt="Cover Buku" style="object-fit: contain; max-width: 100%;">
                            </div>

                            <div class="card-body p-3 d-flex flex-column">
                                <span class="text-primary font-monospace fw-bold mb-1" style="font-size: 0.75rem; text-transform: uppercase;">
                                    <?= htmlspecialchars($buku['genre'] ?? 'Umum') ?>
                                </span>
                                <h6 class="fw-bold text-dark mb-1 text-truncate" title="<?= htmlspecialchars($buku['judul']) ?>">
                                    <?= htmlspecialchars($buku['judul']) ?>
                                </h6>
                                <p class="text-muted small mb-2 text-truncate">Penulis: <span class="text-dark fw-medium"><?= htmlspecialchars($buku['penulis']) ?></span></p>

                                <?php if (!empty($buku['sinopsis'])): ?>
                                    <p class="text-secondary small mb-3 opacity-75" style="font-size: 0.78rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.3em;">
                                        <?= htmlspecialchars($buku['sinopsis']) ?>
                                    </p>
                                <?php else: ?>
                                    <p class="text-muted small mb-3 fst-italic opacity-50" style="font-size: 0.78rem; height: 2.3em;">Tidak ada sinopsis.</p>
                                <?php endif; ?>

                                <div class="mt-auto pt-2 border-top border-light d-flex justify-content-between text-muted" style="font-size: 0.75rem;">
                                    <span><i class="bi bi-calendar3 me-1"></i> <?= $buku['tahun_terbit'] ?? '-' ?></span>
                                    <span><i class="bi bi-book me-1"></i> <?= $buku['jumlah_halaman'] ?? '-' ?> Hal</span>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
                                <a href="index.php?action=public-detail&id=<?= $buku['_id'] ?>" class="btn btn-outline-dark btn-sm w-100 py-2 fw-medium rounded-2">
                                    Lihat Info Lengkap <i class="bi bi-arrow-right-short align-middle"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Sleek Windowed Pagination & Summary -->
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
                        <nav aria-label="Navigasi Halaman Publik">
                            <ul class="pagination pagination-sm mb-0 rounded-pill overflow-hidden border">
                                <!-- First Page & Prev -->
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link border-0 px-2.5" href="index.php?action=landing&page=1&search=<?= urlencode($search) ?>" title="Halaman Pertama">
                                        <i class="bi bi-chevron-double-left"></i>
                                    </a>
                                </li>
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link border-0 px-3" href="index.php?action=landing&page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">
                                        Prev
                                    </a>
                                </li>

                                <!-- Start Ellipsis -->
                                <?php if ($startPage > 1): ?>
                                    <li class="page-item"><a class="page-link border-0 px-3" href="index.php?action=landing&page=1&search=<?= urlencode($search) ?>">1</a></li>
                                    <?php if ($startPage > 2): ?>
                                        <li class="page-item disabled"><span class="page-link border-0 px-2">...</span></li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- Window Range Numbers -->
                                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                        <a class="page-link border-0 px-3 fw-semibold" href="index.php?action=landing&page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- End Ellipsis -->
                                <?php if ($endPage < $totalPages): ?>
                                    <?php if ($endPage < $totalPages - 1): ?>
                                        <li class="page-item disabled"><span class="page-link border-0 px-2">...</span></li>
                                    <?php endif; ?>
                                    <li class="page-item"><a class="page-link border-0 px-3" href="index.php?action=landing&page=<?= $totalPages ?>&search=<?= urlencode($search) ?>"><?= $totalPages ?></a></li>
                                <?php endif; ?>

                                <!-- Next & Last Page -->
                                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link border-0 px-3" href="index.php?action=landing&page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">
                                        Next
                                    </a>
                                </li>
                                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link border-0 px-2.5" href="index.php?action=landing&page=<?= $totalPages ?>&search=<?= urlencode($search) ?>" title="Halaman Terakhir">
                                        <i class="bi bi-chevron-double-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>

        <?php else: ?>
            <div class="text-center py-5 bg-white border rounded-3 shadow-sm my-4">
                <i class="bi bi-search text-muted fs-1 mb-2 d-block"></i>
                <h5 class="text-muted fw-bold mb-1">Arsip buku tidak ditemukan.</h5>
                <?php if (!empty($search)): ?>
                    <p class="text-muted small mb-3">Tidak ada hasil untuk pencarian kata kunci "<?= htmlspecialchars($search) ?>"</p>
                    <a href="index.php?action=landing" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Pencarian
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="bg-white border-top py-4 mt-5 text-center text-muted small">
        <div class="container">
            <p class="mb-0 fw-medium">© 2026 Sistem Katalog Digital. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>

</html>