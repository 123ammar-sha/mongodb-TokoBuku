<?php

require_once __DIR__ . '/../Models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Menampilkan Halaman Login Admin
     */
    public function loginForm()
    {
        // Jika sudah login, langsung lempar ke dashboard
        if (!empty($_SESSION['admin_user'])) {
            header('Location: index.php?action=dashboard');
            exit;
        }

        $error = $_GET['error'] ?? null;
        $success = $_GET['success'] ?? null;

        include 'views/auth/login.php';
    }

    /**
     * Memproses Request Login Form
     */
    public function loginProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=login');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            header('Location: index.php?action=login&error=empty');
            exit;
        }

        $user = $this->userModel->findByUsername(strtolower($username));

        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            // Login Berhasil -> Simpan Session
            $_SESSION['admin_user'] = [
                'id'       => (string) $user['_id'],
                'username' => $user['username'],
                'name'     => $user['name'] ?? 'Administrator',
                'role'     => $user['role'] ?? 'admin'
            ];

            header('Location: index.php?action=dashboard');
            exit;
        }

        // Login Gagal
        header('Location: index.php?action=login&error=invalid');
        exit;
    }

    /**
     * Memproses Logout Admin
     */
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['admin_user']);
        session_destroy();

        header('Location: index.php?action=login&success=logout');
        exit;
    }

    /**
     * Helper Static untuk Proteksi Middleware Rute Admin
     */
    public static function checkAuth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['admin_user'])) {
            header('Location: index.php?action=login&error=unauthorized');
            exit;
        }
    }
}
