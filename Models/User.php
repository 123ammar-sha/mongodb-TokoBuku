<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private $collection;

    public function __construct()
    {
        global $db;
        $this->collection = $db->users;
    }

    /**
     * Cari user berdasarkan username
     */
    public function findByUsername($username)
    {
        return $this->collection->findOne([
            'username' => (string) $username
        ]);
    }

    /**
     * Tambah user baru (dengan hashing password)
     */
    public function create($data)
    {
        $userData = [
            'username' => strtolower(trim($data['username'])),
            'name'     => $data['name'] ?? 'Admin User',
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role'     => $data['role'] ?? 'admin',
            'created_at' => new MongoDB\BSON\UTCDateTime()
        ];

        return $this->collection->insertOne($userData);
    }

    /**
     * Verifikasi password
     */
    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}
