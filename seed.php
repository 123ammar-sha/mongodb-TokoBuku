<?php

require 'vendor/autoload.php';
require 'config/database.php';

// Sesuaikan jika nama collection berbeda
$collection = $db->Buku_Baru;

$judulAwal = [
    "Pemrograman PHP",
    "Belajar MongoDB",
    "Algoritma Dasar",
    "Basis Data Modern",
    "Jaringan Komputer",
    "Artificial Intelligence",
    "Machine Learning",
    "Atomic Habits",
    "Clean Code",
    "Design Patterns",
    "Laravel Mastery",
    "Cyber Security",
    "Data Science",
    "Cloud Computing",
    "Internet of Things"
];

$penulis = [
    "Andi Wijaya",
    "Budi Santoso",
    "Siti Rahma",
    "James Clear",
    "Robert Martin",
    "Ahmad Fauzi",
    "Dewi Lestari",
    "Rina Putri",
    "John Smith",
    "Michael Brown"
];

$genre = [
    "Teknologi",
    "Novel",
    "Pendidikan",
    "Bisnis",
    "Self Improvement",
    "Komputer",
    "Sains",
    "Sejarah"
];

$penerbit = [
    "Gramedia",
    "Elex Media",
    "Informatika",
    "Deepublish",
    "Andi Publisher",
    "Erlangga",
    "Mizan",
    "Bentang Pustaka"
];

$dataBuku = [];

for ($i = 1; $i <= 500; $i++) {

    $dataBuku[] = [

        "judul" => $judulAwal[array_rand($judulAwal)] . " Vol. " . $i,

        "penulis" => $penulis[array_rand($penulis)],

        "tahun_terbit" => rand(2000, 2025),

        "jumlah_halaman" => rand(100, 900),

        "genre" => $genre[array_rand($genre)],

        "penerbit" => $penerbit[array_rand($penerbit)]
    ];
}

$result = $collection->insertMany($dataBuku);

echo "Berhasil menambahkan "
    . $result->getInsertedCount()
    . " buku.";
