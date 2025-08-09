<?php
session_start();
require 'includes/conexion.php';

// Si no hay sesión, redirige
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Verificar ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: contactos.php');
    exit;
}

$id = $_GET['id'];

// Eliminar solo si pertenece al usuario
$stmt = $pdo->prepare("DELETE FROM contactos WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $usuario_id]);

header('Location: contactos.php');
exit;
?>
