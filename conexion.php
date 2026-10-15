<?php
// conexion.php
// Ajustá estos datos según tu configuración local de XAMPP/phpMyAdmin.

$host   = 'localhost';
$dbname = 'biblioteca';
$user   = 'root';
$pass   = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
