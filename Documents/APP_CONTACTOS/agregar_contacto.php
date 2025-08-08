<?php
session_start();
require 'includes/conexion.php';

// Si el usuario no está logueado, lo manda al login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Si no llega un ID válido, redirige
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: contactos.php');
    exit;
}

$id = $_GET['id'];

// Cuando envíe el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y validar entradas
    $nombre   = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $email    = trim($_POST['email'] ?? '');

    // Insertar nuevo contacto
    $stmt = $pdo->prepare("INSERT INTO contactos (usuario_id, nombre, telefono, email, fecha_creacion) VALUES (?, ?, ?, ?, NOW())");
    // proteccion a iny
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Redirigir a la lista de contactos
    header('Location: contactos.php');
    exit;
}
?>
<!-- formulario de agregado de nuevo contacto -->
<h2>Agregar Nuevo Contacto</h2>
<form method="post">
    <label for="nombre">Nombre de contacto:</label>
    <input type="text" name="nombre" placeholder="Nombre" required><br><br>
    <label for="telefono">Numero de telefono:</label>
    <input type="text" name="telefono" placeholder="Teléfono" required><br><br>
    <label for="email">Correo electronico:</label>
    <input type="email" name="email" placeholder="Correo electronico" required><br><br>
    <button type="submit">Crear</button>
</form>
<a href="contactos.php">Volver</a>

