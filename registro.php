<?php
session_start();
include 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $contrasena = $_POST["contrasena"];
    $confirmar = $_POST["confirmar"];

    if ($contrasena !== $confirmar) {
        $mensaje = "❌ Las contraseñas no coinciden.";
    } else {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $fecha = date("Y-m-d H:i:s");

        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contrasena, fecha_registro) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $hash, $fecha);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $mensaje = "❌ Error al registrar. ¿Ya existe ese correo?";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="estilos/estilos.css">
</head>
<body>

<form method="POST" action="registro.php">
    <h2>Crear cuenta</h2>
    <input type="text" name="nombre" placeholder="Nombre completo" required><br>
    <input type="email" name="correo" placeholder="Correo electrónico" required><br>
    <input type="password" name="contrasena" placeholder="Contraseña" required><br>
    <input type="password" name="confirmar" placeholder="Confirmar contraseña" required><br>
    <button type="submit">Registrarse</button>
</form>

<?php
if (!empty($mensaje)) {
    echo "<p>$mensaje</p>";
}
?>

</body>
</html>


