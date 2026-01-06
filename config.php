<?php
// config.php - Konfigurasi Database

// Informasi koneksi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gaming_db');

// Buat koneksi menggunakan MySQLi
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset UTF-8
$conn->set_charset("utf8mb4");

// Fungsi helper untuk query
function query($sql)
{
  global $conn;
  $result = $conn->query($sql);

  if (!$result) {
    die("Query error: " . $conn->error);
  }

  return $result;
}

// Fungsi untuk escape string (keamanan SQL injection)
function escape($string)
{
  global $conn;
  return $conn->real_escape_string($string);
}

// Start session untuk login
session_start();
?>