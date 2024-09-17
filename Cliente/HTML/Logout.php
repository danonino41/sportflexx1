<?php
session_start();
// Destruir todas las sesiones
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            Sesión cerrada exitosamente. Redirigiendo a la página de inicio de sesión...
        </div>
    </div>
    <script>
        // Redirigir a la página de inicio de sesión después de 3 segundos
        setTimeout(() => {
            window.location.href = "../PHP/login2.php";
        }, 1000);
    </script>
</body>
</html>