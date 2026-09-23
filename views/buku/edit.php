<?php include 'views/layouts/header.php'; ?>
<?php include 'views/layouts/sidebar.php'; ?>

<div class="content container mt-4">

    <div class="mb-3">
        <a href="index.php" class="text-decoration-none text-muted small fw-medium d-inline-flex align-items-center gap-1 hover-link">
            ← Batal dan Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

        <div class="card-body p-4 p-md-5 border-bottom border-light-subtle bg-light-subtle">
            <div class="d-flex align-items-center gap-2">
                <div class="bg-warning text-dark rounded-3 p-2 d-inline-flex shadow-sm">
                    <i class="bi bi-pencil-square fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">Perbarui Data Buku</h4>
                </div>
            </div>
        </div>

        <div class="card-body p-4 p-md-5">
            <form method="POST" action="index.php?action=update&id=<?= $buku['_id'] ?>" enctype="multipart/form-data">

                <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light-subtle" style="font-size: 1rem; letter-spacing: 0.5px;">
                    1. Informasi Utama
                </h5>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control form-control-lg fs-6 rounded-2 shadow-sm" value="<?= htmlspecialchars($buku['judul']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Nama Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="penulis" class="form-control form-control-lg fs-6 rounded-2 shadow-sm" value="<?= htmlspecialchars($buku['penulis']) ?>" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small">Sinopsis / Ringkasan Buku</label>
                    <textarea name="sinopsis" class="form-control rounded-2 shadow-sm" rows="3" placeholder="Tuliskan ringkasan alur cerita atau gambaran singkat isi buku..."><?= htmlspecialchars($buku['sinopsis'] ?? '') ?></textarea>
                </div>

                <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light-subtle" style="font-size: 1rem; letter-spacing: 0.5px;">
                    2. Spesifikasi Penerbitan
                </h5>
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Genre / Kategori</label>
                        <input type="text" name="genre" class="form-control rounded-2" value="<?= htmlspecialchars($buku['genre'] ?? '') ?>">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control rounded-2" value="<?= htmlspecialchars($buku['penerbit'] ?? '') ?>">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control rounded-2" value="<?= $buku['tahun_terbit'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Jumlah Halaman</label>
                        <div class="input-group">
                            <input type="number" name="jumlah_halaman" class="form-control rounded-start-2" value="<?= $buku['jumlah_halaman'] ?? '' ?>">
                            <span class="input-group-text text-muted small bg-light">Hal</span>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light-subtle" style="font-size: 1rem; letter-spacing: 0.5px;">
                    3. Harga & Stok Gudang <span class="text-muted fw-normal font-monospace" style="font-size: 0.8rem;">(Fleksibel MongoDB)</span>
                </h5>
                <div class="row g-3 mb-4 p-3 bg-light rounded-3 border border-light-subtle mx-0">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-secondary small">Harga Jual (Rp)</label>
                        <div class="input-group shadow-sm rounded-2 overflow-hidden">
                            <span class="input-group-text bg-warning-subtle text-warning-emphasis border-0 fw-bold">Rp</span>
                            <input type="number" name="harga" class="form-control border-0" step="100" value="<?= $buku['harga'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <label class="form-label fw-semibold text-secondary small">Stok Gudang</label>
                        <div class="input-group shadow-sm rounded-2 overflow-hidden">
                            <input type="number" name="stok" class="form-control border-0" value="<?= $buku['stok'] ?? '' ?>">
                            <span class="input-group-text bg-white border-0 text-muted small">Pcs</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <label class="form-label fw-semibold text-secondary small">Diskon Promo</label>
                        <div class="input-group shadow-sm rounded-2 overflow-hidden">
                            <input type="number" name="diskon" class="form-control border-0" step="0.1" value="<?= $buku['diskon'] ?? '' ?>">
                            <span class="input-group-text bg-danger-subtle text-danger border-0 fw-bold">%</span>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light-subtle" style="font-size: 1rem; letter-spacing: 0.5px;">
                    4. Visual Buku & Image Preview
                </h5>
                <div class="row align-items-center g-3 mb-5">
                    <div class="col-auto">
                        <div class="bg-light p-1.5 rounded-2 border border-light-subtle shadow-sm" style="width: 70px; height: 95px; overflow: hidden;">
                            <img id="currentCover" src="uploads/<?= $buku['cover'] ?? 'default.png' ?>" class="w-100 h-100 rounded-1" style="object-fit: cover;" alt="Current Cover">
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label fw-semibold text-secondary small mb-1">Ganti Cover Buku <span class="text-muted fw-normal">(Opsional)</span></label>
                        <input type="file" name="cover" class="form-control custom-file-input shadow-sm rounded-2" accept="image/*" onchange="previewImage(this, 'currentCover')">
                        <div class="form-text text-muted small mt-1">Biarkan kosong jika tidak ingin mengubah cover aktif saat ini. Gambar akan langsung diperbarui secara live di sebelah kiri.</div>
                    </div>
                </div>

                <div class="d-flex gap-2 pt-3 border-top border-light-subtle">
                    <button class="btn btn-warning px-4 rounded-pill fw-medium shadow-sm text-dark">
                        Simpan Perubahan
                    </button>
                    <a href="index.php?action=index" class="btn btn-outline-secondary px-4 rounded-pill fw-medium">
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
    function previewImage(input, targetId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const target = document.getElementById(targetId);
                if (target) {
                    target.src = e.target.result;
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    .hover-link {
        transition: color 0.2s;
    }

    .hover-link:hover {
        color: #0d6efd !important;
    }

    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.18);
    }

    .p-1.5 {
        padding: 0.35rem;
    }
</style>

<?php include 'views/layouts/footer.php'; ?>