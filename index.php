<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load controller yang dibutuhkan
require_once 'controllers/BukuController.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/AuthController.php';

// Saat pertama kali diakses (tanpa parameter), otomatis arahkan ke 'landing'
$action = $_GET['action'] ?? 'landing';
$id = $_GET['id'] ?? null;

switch ($action) {
    // ==========================================
    // RUTE AUTENTIKASI ADMIN
    // ==========================================
    case 'login':
        $authController = new AuthController();
        $authController->loginForm();
        break;

    case 'login-process':
        $authController = new AuthController();
        $authController->loginProcess();
        break;

    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;

    // ==========================================
    // RUTE PELANGGAN (Halaman Depan / Publik)
    // ==========================================
    case 'landing':
        $homeController = new HomeController();
        $homeController->index();
        break;

    case 'public-detail':
        $homeController = new HomeController();
        $homeController->detail($id);
        break;

    // ==========================================
    // RUTE ADMIN (Terproteksi Auth Middleware)
    // ==========================================
    case 'index': // Rute Kelola Buku versi Admin
        AuthController::checkAuth();
        $bukuController = new BukuController();
        $bukuController->index();
        break;

    case 'dashboard':
        AuthController::checkAuth();
        $bukuController = new BukuController();
        $bukuController->dashboard();
        break;

    case 'tambah':
        AuthController::checkAuth();
        $bukuController = new BukuController();
        $bukuController->create();
        break;

    case 'store':
        AuthController::checkAuth();
        $bukuController = new BukuController();
        $bukuController->store();
        break;

    case 'detail':
        AuthController::checkAuth();
        $bukuController = new BukuController();
        $bukuController->detail($id);
        break;

    case 'edit':
        AuthController::checkAuth();
        $bukuController = new BukuController();
        $bukuController->edit($id);
        break;

    case 'update':
        AuthController::checkAuth();
        $bukuController = new BukuController();
        $bukuController->update($id);
        break;

    case 'delete':
        AuthController::checkAuth();
        $bukuController = new BukuController();
        $bukuController->delete($id);
        break;

    // Fallback jika mengetik action yang tidak terdaftar
    default:
        $homeController = new HomeController();
        $homeController->index();
        break;
}
