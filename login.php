<?php
session_start();
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos/estilos.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f5dc; /* Beige */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 10px;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Logotipo centrado -->
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToT2zNU4CUA0W20SOi_TycevAfFvsO2g-ZYQ&s" alt="Logo" class="logo">

<!-- Formulario -->
<form method="POST">
    <h2>Iniciar Sesión</h2>
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
    <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
</form>

<!-- Validación PHP -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    $stmt = $conexion->prepare("SELECT id, nombre, contrasena FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $nombre, $hash);
        $stmt->fetch();
        if (password_verify($contrasena, $hash)) {
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nombre'] = $nombre;
            header("Location: index.php");
            exit;
        } else {
            echo "<p style='color:red;'>❌ Contraseña incorrecta.</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ Usuario no encontrado.</p>";
    }
}
?>

</body>
</html>



