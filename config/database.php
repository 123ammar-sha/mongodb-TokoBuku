<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Parse .env file if it exists
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) {
            continue;
        }
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value, " \t\n\r\0\x0B\"'");
            if (!getenv($name)) {
                putenv("{$name}={$value}");
                $_ENV[$name] = $value;
            }
        }
    }
}

$url = getenv('MONGO_URI') ?: "mongodb://127.0.0.1:27017";
$client = new MongoDB\Client($url);

$db = $client->toko_buku;

$collection = $db->Buku_Baru;
$userCollection = $db->users;
