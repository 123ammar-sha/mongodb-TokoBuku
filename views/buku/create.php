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
                <div class="bg-primary text-white rounded-3 p-2 d-inline-flex shadow-sm">
                    <i class="bi bi-journal-plus fs-4"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-0">Tambah Koleksi Buku</h4>
                    <small class="text-muted">Isi formulir di bawah ini dengan lengkap untuk menambahkan buku baru.</small>
                </div>
            </div>
        </div>

        <div class="card-body p-4 p-md-5">
            <form method="POST" action="index.php?action=store" enctype="multipart/form-data">

                <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light-subtle" style="font-size: 1rem; letter-spacing: 0.5px;">
                    1. Informasi Utama
                </h5>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control form-control-lg fs-6 rounded-2 shadow-sm" placeholder="Masukkan judul lengkap buku" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small">Nama Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="penulis" class="form-control form-control-lg fs-6 rounded-2 shadow-sm" placeholder="Masukkan nama lengkap penulis" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small">Sinopsis / Ringkasan Buku</label>
                    <textarea name="sinopsis" class="form-control rounded-2 shadow-sm" rows="3" placeholder="Tuliskan ringkasan alur cerita atau gambaran singkat isi buku..."></textarea>
                </div>

                <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light-subtle" style="font-size: 1rem; letter-spacing: 0.5px;">
                    2. Spesifikasi Penerbitan
                </h5>
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Genre / Kategori</label>
                        <input type="text" name="genre" class="form-control rounded-2" placeholder="Contoh: Fiksi, Bisnis">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control rounded-2" placeholder="Nama perusahaan penerbit">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control rounded-2" placeholder="Contoh: 2024">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label fw-semibold text-secondary small">Jumlah Halaman</label>
                        <div class="input-group">
                            <input type="number" name="jumlah_halaman" class="form-control rounded-start-2" placeholder="0">
                            <span class="input-group-text text-muted small bg-light">Hal</span>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light-subtle" style="font-size: 1rem; letter-spacing: 0.5px;">
                    3. Harga & Stok Gudang
                </h5>
                <div class="row g-3 mb-4 p-3 bg-light rounded-3 border border-light-subtle mx-0">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-secondary small">Harga Jual</label>
                        <div class="input-group shadow-sm rounded-2 overflow-hidden">
                            <span class="input-group-text bg-primary-subtle text-primary border-0 fw-bold">Rp</span>
                            <input type="number" name="harga" class="form-control border-0" step="100" placeholder="75000">
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <label class="form-label fw-semibold text-secondary small">Stok Awal</label>
                        <div class="input-group shadow-sm rounded-2 overflow-hidden">
                            <input type="number" name="stok" class="form-control border-0" placeholder="0">
                            <span class="input-group-text bg-white border-0 text-muted small">Pcs</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <label class="form-label fw-semibold text-secondary small">Diskon Promo</label>
                        <div class="input-group shadow-sm rounded-2 overflow-hidden">
                            <input type="number" name="diskon" class="form-control border-0" step="0.1" placeholder="0">
                            <span class="input-group-text bg-danger-subtle text-danger border-0 fw-bold">%</span>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom border-light-subtle" style="font-size: 1rem; letter-spacing: 0.5px;">
                    4. Visual Buku & Image Preview
                </h5>
                <div class="mb-5">
                    <label class="form-label fw-semibold text-secondary small">Upload Cover Buku</label>
                    <input type="file" name="cover" id="coverInput" class="form-control custom-file-input shadow-sm rounded-2" accept="image/*" onchange="previewImage(this, 'coverPreview')">
                    <div class="form-text text-muted small mt-1">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</div>

                    <div id="previewContainer" class="mt-3 d-none">
                        <p class="small text-muted mb-1 fw-semibold">Preview Gambar Cover:</p>
                        <img id="coverPreview" src="#" alt="Preview Cover" class="rounded-2 shadow-sm border p-1" style="max-height: 180px; object-fit: contain;">
                    </div>
                </div>

                <div class="d-flex gap-2 pt-3 border-top border-light-subtle">
                    <button class="btn btn-primary px-4 rounded-pill fw-medium shadow-sm">
                        Simpan Buku Baru
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
                    const container = document.getElementById('previewContainer');
                    if (container) container.classList.remove('d-none');
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
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
</style>

<?php include 'views/layouts/footer.php'; ?>