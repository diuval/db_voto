<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Votación de Frutas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .bienvenida {
            background-color: #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        .fondo-beige {
            background-color: #f5f5dc;
            padding: 30px;
            border-radius: 12px;
            margin-top: 30px;
        }

        .opciones {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .opcion {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            width: 260px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .foto-candidato {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            margin: 0 auto 15px auto;
            display: block;
        }

        .opcion h3 { margin-top: 10px; }
        .opcion ul { text-align: left; padding-left: 20px; }
        .opcion label {
            margin-top: 15px;
            font-weight: bold;
            display: block;
        }

        .boton-votar {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="bienvenida">
        <h2>Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?></h2>
        <a href="logout.php" class="btn btn-outline-danger btn-sm mt-2">Cerrar sesión</a>
    </div>

    <form action="votar.php" method="POST" class="fondo-beige">
        <h2 class="text-center mb-4">¿Cuál candidato prefieres?</h2>

        <div class="opciones">
            <!-- Pedro Castillo -->
            <div class="opcion">
                <img src="https://elperuano.pe/fotografia/thumbnail/2021/04/12/000113796M.jpg" alt="Pedro Castillo" class="foto-candidato">
                <h3>Pedro Castillo</h3>
                <p>📍 Lugar de nacimiento: Cajamarca</p>
                <ul>
                    <li>Aumentar impuestos a la minería</li>
                    <li>Créditos sin intereses para campesinos</li>
                    <li>Ampliación de programas sociales</li>
                </ul>
                <label><input type="radio" name="candidato" value="Pedro Castillo" required> Votar por Pedro Castillo</label>
            </div>

            <!-- Keiko Fujimori -->
            <div class="opcion">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSircVrljTiJB9rWml00GXmMeBk6-jNbXjIJg&s" alt="Keiko Fujimori" class="foto-candidato">
                <h3>Keiko Fujimori</h3>
                <p>📍 Lugar de nacimiento: Lima</p>
                <ul>
                    <li>Extradición de criminales</li>
                    <li>Reducción de impuestos a empresas</li>
                    <li>Fomento al emprendimiento</li>
                </ul>
                <label><input type="radio" name="candidato" value="Keiko Fujimori" required> Votar por Keiko Fujimori</label>
            </div>

            <!-- Hernando de Soto -->
            <div class="opcion">
                <img src="https://thinkingheads.com/wp-content/uploads/2024/11/hernando-soto-economista-conferenciante-thinking-heads.jpg" alt="Hernando de Soto" class="foto-candidato">
                <h3>Hernando de Soto</h3>
                <p>📍 Lugar de nacimiento: Arequipa</p>
                <ul>
                    <li>Simplificación de trámites</li>
                    <li>Combate a la corrupción</li>
                    <li>Titulación de tierras</li>
                </ul>
                <label><input type="radio" name="candidato" value="Hernando de Soto" required> Votar por Hernando de Soto</label>
            </div>

            <!-- Yonhy Lescano -->
            <div class="opcion">
                <img src="https://pbs.twimg.com/profile_images/991790180129476608/w-QUgKQT_400x400.jpg" alt="Yonhy Lescano" class="foto-candidato">
                <h3>Yonhy Lescano</h3>
                <p>📍 Lugar de nacimiento: Puno</p>
                <ul>
                    <li>Fortalecer independencia judicial</li>
                    <li>Confiscación de bienes por corrupción</li>
                    <li>Capacitación docente tecnológica</li>
                </ul>
                <label><input type="radio" name="candidato" value="Yonhy Lescano" required> Votar por Yonhy Lescano</label>
            </div>

            <!-- En Blanco -->
            <div class="opcion">
                <img src="https://www.laizquierdadiario.pe/IMG/arton27915.jpg?1448065678" alt="Voto en Blanco" class="foto-candidato">
                <h3>🗳️ En blanco</h3>
                <p>📍 No deseas votar por ningún candidato.</p>
                <ul>
                    <li>Tu voto es neutral</li>
                    <li>No influye en el resultado</li>
                    <li>Opción válida de participación</li>
                </ul>
                <label><input type="radio" name="candidato" value="En blanco" required> Votar en Blanco</label>
            </div>
        </div>

        <div class="boton-votar">
            <button type="submit" class="btn btn-success">Votar</button>
        </div>
    </form>
</div>

</body>
</html>




