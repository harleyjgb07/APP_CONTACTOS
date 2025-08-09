<?php
session_start();
require 'includes/conexion.php';

// Si el usuario no está logueado, lo manda al login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Cuando envíe el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // Insertar nuevo contacto
    $stmt = $pdo->prepare("INSERT INTO contactos (usuario_id, nombre, telefono, email, fecha_creacion) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$usuario_id, $nombre, $telefono, $email]);

    // Redirigir a la lista de contactos
    header('Location: contactos.php');
    exit;
}
?>

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

