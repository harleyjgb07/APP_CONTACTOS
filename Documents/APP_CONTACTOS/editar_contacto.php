<?php
session_start();
require 'includes/conexion.php';

// Si no hay sesión, redirige
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Si no llega un ID válido, redirige
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: contactos.php');
    exit;
}

$id = $_GET['id'];

// Obtener datos del contacto
$stmt = $pdo->prepare("SELECT * FROM contactos WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $usuario_id]);
$contacto = $stmt->fetch();

if (!$contacto) {
    die("Contacto no encontrado o no tienes permiso para editarlo.");
}

// Si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // Actualizar contacto
    $stmt = $pdo->prepare("UPDATE contactos SET nombre = ?, telefono = ?, email = ? WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$nombre, $telefono, $email, $id, $usuario_id]);
    // se redirige a la lista de los contactos
    header("Location: contactos.php");
    exit;
}
?>
<!-- formulario para editar contacto -->
<h2>Editar Contacto</h2>
<form method="post">
    <label for="nombre">Nombre de contacto:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($contacto['nombre']); ?>" required><br><br>
    <label for="telefono">Numero de telefono:</label>
    <input type="text" name="telefono" value="<?php echo htmlspecialchars($contacto['telefono']); ?>" required><br><br>
    <label for="email">Correo electronico:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($contacto['email']); ?>" required><br><br>
    <button type="submit">Guardar Cambios</button>
</form>
<a href="contactos.php">Cancelar</a>