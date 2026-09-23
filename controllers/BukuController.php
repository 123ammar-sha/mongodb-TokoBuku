<?php
require_once __DIR__ . '/../Models/Buku.php';

class BukuController
{
    private $buku;

    public function __construct()
    {
        // Inisialisasi Model Buku (Koneksi ke MongoDB melalui Model)
        $this->buku = new Buku();
    }

    /**
     * Halaman Utama Kelola Buku (Khusus Admin)
     */
    public function index()
    {
        $search = trim($_GET['search'] ?? '');
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $limit = 8;

        // Ambil data buku dengan pagination & filter pencarian
        $bukuCursor = $this->buku->getPaginated($page, $limit, $search);
        $data = iterator_to_array($bukuCursor);

        $totalItems = $this->buku->countTotal($search);
        $totalPages = max(1, (int) ceil($totalItems / $limit));

        // Ambil data untuk statistik pencarian
        $statCursor = !empty($search) ? $this->buku->search($search) : $this->buku->getAll();
        $statData = iterator_to_array($statCursor);

        $totalBukuHasil = count($statData);
        $totalGenreHasil = count(array_unique(array_filter(array_column($statData, 'genre'))));
        $totalPenulisHasil = count(array_unique(array_filter(array_column($statData, 'penulis'))));

        // Memanggil View Daftar Buku Admin
        include 'views/buku/index.php';
    }

    /**
     * Halaman Dashboard Utama Admin (Statistik & Grafik)
     */
    public function dashboard()
    {
        $bukuCursor = $this->buku->getAll();
        $data = iterator_to_array($bukuCursor);

        // Menghitung ringkasan data untuk komponen widget dashboard
        $totalBuku = count($data);
        $totalGenre = count(array_unique(array_column($data, 'genre')));
        $totalPenulis = count(array_unique(array_filter(array_column($data, 'penulis'))));
        $totalPenerbit = count(array_unique(array_filter(array_column($data, 'penerbit'))));

        // FIX: Filter nilai yang valid (hanya string dan integer)
        $genres = array_filter(array_column($data, 'genre'), function ($value) {
            return is_string($value) || is_int($value);
        });
        $genreCount = array_count_values($genres);

        $penulisList = array_filter(array_column($data, 'penulis'), function ($value) {
            return is_string($value) || is_int($value);
        });
        $penulisCount = array_count_values($penulisList);

        $penerbitList = array_filter(array_column($data, 'penerbit'), function ($value) {
            return is_string($value) || is_int($value);
        });
        $penerbitCount = array_count_values($penerbitList);

        // Mengambil 5 buku terbaru yang dimasukkan (di-reverse berdasarkan input terakhir)
        $bukuTerbaru = array_slice(array_reverse($data), 0, 5);

        // Memanggil View Dashboard Admin
        include 'views/dashboard.php';
    }

    /**
     * Menampilkan Form Tambah Buku Baru
     */
    public function create()
    {
        include 'views/buku/create.php';
    }

    /**
     * Memproses Penyimpanan Data Buku ke MongoDB
     */
    public function store()
    {
        $coverName = null;

        // Validasi dan Proses Upload File Gambar Cover Buku
        if (!empty($_FILES['cover']['name'])) {
            $fileName = time() . '_' . $_FILES['cover']['name'];
            $target = __DIR__ . "/../uploads/" . $fileName;

            move_uploaded_file($_FILES['cover']['tmp_name'], $target);
            $coverName = $fileName;
        }

        // Mapping data utama dengan casting tipe data data primitif
        $data = [
            'judul' => $_POST['judul'],
            'penulis' => (string) $_POST['penulis'],
            'tahun_terbit' => (int) $_POST['tahun_terbit'],
            'jumlah_halaman' => (int) $_POST['jumlah_halaman'],
            'genre' => $_POST['genre'],
            'penerbit' => $_POST['penerbit'],
            'cover' => $coverName,
            'sinopsis' => $_POST['sinopsis'] ?? null
        ];

        // Sifat Fleksibel Dokumen NoSQL: Hanya diisi jika admin memasukkan nilai
        if (!empty($_POST['harga'])) {
            $data['harga'] = (float) $_POST['harga'];
        }
        if (!empty($_POST['stok'])) {
            $data['stok'] = (int) $_POST['stok'];
        }
        if (!empty($_POST['diskon'])) {
            $data['diskon'] = (float) $_POST['diskon'];
        }

        // Perintah Insert ke Database
        $this->buku->insert($data);

        // FIX: Diarahkan kembali ke halaman kelola buku milik Admin dengan parameter sukses
        header('Location: index.php?action=index&success=tambah');
        exit;
    }

    /**
     * Menampilkan Detail Buku (Sisi Admin)
     */
    public function detail($id)
    {
        $buku = $this->buku->getById($id);
        include 'views/buku/detail.php';
    }

    /**
     * Menampilkan Form Edit Buku Berdasarkan ID
     */
    public function edit($id)
    {
        $buku = $this->buku->getById($id);
        include 'views/buku/edit.php';
    }

    /**
     * Memproses Pembaruan Data Buku Berdasarkan ID
     */
    public function update($id)
    {
        $coverName = null;

        // Proses Upload jika admin mengunggah file cover baru
        if (!empty($_FILES['cover']['name'])) {
            $fileName = time() . '_' . $_FILES['cover']['name'];
            $target = __DIR__ . "/../uploads/" . $fileName;

            move_uploaded_file($_FILES['cover']['tmp_name'], $target);
            $coverName = $fileName;
        }

        // Data utama yang wajib diperbarui
        $data = [
            'judul' => $_POST['judul'],
            'penulis' => (string) $_POST['penulis'],
            'tahun_terbit' => (int) $_POST['tahun_terbit'],
            'jumlah_halaman' => (int) $_POST['jumlah_halaman'],
            'genre' => $_POST['genre'],
            'penerbit' => $_POST['penerbit'],
        ];

        // Ganti cover hanya jika ada file baru yang diunggah
        if (!empty($coverName)) {
            $data['cover'] = $coverName;
        }

        // Mempertahankan fitur NoSQL fleksibel ($unset/null jika input dikosongkan)
        $data['harga'] = !empty($_POST['harga']) ? (float) $_POST['harga'] : null;
        $data['stok'] = !empty($_POST['stok']) ? (int) $_POST['stok'] : null;
        $data['diskon'] = !empty($_POST['diskon']) ? (float) $_POST['diskon'] : null;
        $data['sinopsis'] = !empty($_POST['sinopsis']) ? $_POST['sinopsis'] : null;

        // Eksekusi update data ke Model
        $this->buku->update($id, $data);

        // FIX: Diarahkan kembali ke halaman kelola buku milik Admin dengan parameter sukses
        header('Location: index.php?action=index&success=edit');
        exit;
    }

    /**
     * Menghapus Data Buku Sekaligus Menghapus Berkas Gambarnya
     */
    public function delete($id)
    {
        $buku = $this->buku->getById($id);

        // Hapus file gambar fisik dari folder 'uploads' jika bukan gambar default
        if (!empty($buku['cover']) && $buku['cover'] !== 'default.png') {
            $filePath = __DIR__ . "/../uploads/" . $buku['cover'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus dokumen dari MongoDB
        $this->buku->delete($id);

        // FIX: Diarahkan kembali ke halaman kelola buku milik Admin dengan parameter sukses
        header("Location: index.php?action=index&success=hapus");
        exit;
    }
}
