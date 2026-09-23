<?php
require_once __DIR__ . '/../Models/Buku.php';

class HomeController
{
    private $buku;

    public function __construct()
    {
        $this->buku = new Buku();
    }

    // Menampilkan Landing Page Utama (Katalog Murni dengan Pagination)
    public function index()
    {
        $search = trim($_GET['search'] ?? '');
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $limit = 8;

        $bukuCursor = $this->buku->getPaginated($page, $limit, $search);
        $data = iterator_to_array($bukuCursor);

        $totalItems = $this->buku->countTotal($search);
        $totalPages = max(1, (int) ceil($totalItems / $limit));

        include 'views/public/landing.php';
    }

    // FIX: Sekarang mengarah ke lembar presentasi spesifikasi publik tanpa menu admin
    public function detail($id)
    {
        $buku = $this->buku->getById($id);

        // Diubah ke folder views/public/detail.php
        include 'views/public/detail.php';
    }
}
