<?php
$servidor = "localhost";
$base_datos = "app_contactos";
$usuario = "root";
$password = "0000";

try {
    $pdo = new PDO("mysql:host=$servidor;dbname=$base_datos;charset=utf8mb4", $usuario, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("✖️ Conexión fallida: " . $e->getMessage());
}
?>