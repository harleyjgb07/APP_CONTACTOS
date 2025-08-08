<?php
session_start();
require 'includes/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$usuario_id = $_SESSION['usuario_id'];

$usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare("SELECT * FROM contactos WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);
$contactos = $stmt->fetchAll();
?>

<h2>Mis Contactos</h2>
<a href="login.php">Cerrar sesión</a> | <a href="agregar_contacto.php">Agregar contacto</a>


<?php if (empty($contactos)): ?>
    <p>Aún no tienes contactos</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($contactos as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['nombre']) ?></td>
                <td><?= htmlspecialchars($c['telefono']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td>
                    <a href="editar_contacto.php?id=<?= $c['id'] ?>">Editar</a> |
                    <a href="eliminar_contacto.php?id=<?= $c['id'] ?>" onclick="return confirm('¿Seguro?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
