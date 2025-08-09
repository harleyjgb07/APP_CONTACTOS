<?php
require 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

   
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo "⚠️ Ya existe un usuario con ese correo.";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $email, $password]);

    header("Location: index.php");
    exit;
}
?>

<h2>Registro de Usuario</h2>
<form action="registro.php" method="POST">
  <label for="nombre">Ingrese su nombre:</label>
  <input type="text" name="nombre" placeholder="Nombre" required><br><br>
  
  <label for="email">Ingrese su correo electrónico:</label>
  <input type="email" name="email" placeholder="Correo" required><br><br>
  
  <label for="password">Ingrese su contraseña:</label>
  <input type="password" name="password" placeholder="Contraseña" required><br><br>
  
  <button type="submit">Registrarse</button><br>
  <a href="index.php">volver</a>
</form>
