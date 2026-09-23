<?php
require_once __DIR__ . '/Models/User.php';

echo "============================================\n";
echo " SEEDING ADMIN USER TO MONGODB COLLECTION   \n";
echo "============================================\n";

try {
    $userModel = new User();

    $username = 'admin';
    $password = 'admin123';
    $name     = 'Administrator TokoBuku';

    $existingUser = $userModel->findByUsername($username);

    if ($existingUser) {
        echo "[INFO] User '$username' sudah ada di collection 'users'. Skip seeding.\n";
    } else {
        $result = $userModel->create([
            'username' => $username,
            'password' => $password,
            'name'     => $name,
            'role'     => 'admin'
        ]);

        if ($result->getInsertedCount() > 0) {
            echo "[BERHASIL] Admin user berhasil didaftarkan!\n";
            echo "Username : $username\n";
            echo "Password : $password\n";
            echo "ID       : " . $result->getInsertedId() . "\n";
        } else {
            echo "[GAGAL] Gagal memasukkan data user ke MongoDB.\n";
        }
    }
} catch (Exception $e) {
    echo "[ERROR] Terjadi kesalahan: " . $e->getMessage() . "\n";
}
echo "============================================\n";
