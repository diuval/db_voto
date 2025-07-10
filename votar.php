<?php
session_start();
include 'conexion.php';

// Verificar si el usuario ya votó
$usuario_id = $_SESSION['usuario_id'];

$stmt = $conexion->prepare("SELECT id FROM votos WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->store_result();

$ya_voto = $stmt->num_rows > 0;
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Votación</title>
    <link rel="stylesheet" href="estilos/estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc; /* beige */
            padding: 50px;
            text-align: center;
        }

        .mensaje {
            background-color: burlywood;
            padding: 30px;
            margin: 0 auto;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        .mensaje p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .cerrar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dc3545;
            color: black;
            text-decoration: none;
            border-radius: 5px;
        }

        .cerrar:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="mensaje">
<?php
if ($ya_voto) {
    echo "<p>⚠️ Tu voto fue registrado, no puedes volver a votar o elegir nuevamente.</p>";
} else {
    if (isset($_POST['candidato'])) {
        $candidato = $_POST['candidato'];
        $stmt = $conexion->prepare("INSERT INTO votos (candidato, usuario_id) VALUES (?, ?)");
        $stmt->bind_param("si", $candidato, $usuario_id);

        if ($stmt->execute()) {
            echo "<p>✅ Voto registrado correctamente.</p>";
        } else {
            echo "<p>❌ Error al registrar el voto.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>⚠️ No se recibió ningún voto.</p>";
    }
}
?>
    <a class="cerrar" href="logout.php">Cerrar sesión</a>
</div>

</body>
</html>

<?php
$conexion->close();
?>


