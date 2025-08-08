<?php
require 'includes/conexion.php';
if(!isset($pdo)){
    die("✖️ La conexion no se cargo correctamente");
}
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password FROM usuarios WHERE email = :email LIMIT 1");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header("Location: contactos.php");
        exit;
    } else {
        echo "⚠️ Credenciales incorrectas";
        
    }
}
?>

<h2>Iniciar sesión</h2>
<form action="" method="post">
  <label for="email">Correo electronico:</label>
  <input type="email" name="email" placeholder="Correo electronico" required><br><br>
  <label for="password">Contraseña:</label>
  <input type="password" name="password" placeholder="Contraseña" required><br><br>
  <button type="submit">Iniciar sesión</button><br>
  <a href="registro.php">volver</a>
</form>
