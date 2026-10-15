<?php
session_start();
// si ya se inicio la sesion, no tiene sentido que se inicie otra vez.
if (isset($_SESSION["usuario"])) {
    header("Location: index.php?accion=listar");
    exit;
}

// aca se guarda los usuarios, contraseña "correctos".
$usuarios_correctos = ["seba", "joseph", "matias", "pilar", "kevin"];
$clave_correcta = "123";

$mensaje_error = "";

// esta parte se ejecuta solo cuando se envía el formulario (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario_ingresado = $_POST["usuario"];
    $clave_ingresada = $_POST["contrasena"];

    // se evalua si el usuario ingresado esta en la lista y la contraseña es correcta
    if (in_array($usuario_ingresado, $usuarios_correctos) && $clave_ingresada == $clave_correcta) {
        // usuario y contraseña correctos se guarda la sesion
        $_SESSION["usuario"] = $usuario_ingresado;
        header("Location: index.php?accion=listar");
        exit;
    } else {
        $mensaje_error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - Biblioteca UTU | XA Labs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- style de la pagina -->
    <link href="style.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card p-4" style="max-width: 380px; width: 100%;">

       <div class="text-center mb-3">
        <img src="img/xalabs1.png" alt="Logo XA Labs" style="max-height: 80px; width: auto;" class="mb-2">
        <h4 class="fw-bold" style="color:#2E7D32;">Biblioteca UTU</h4>
        <p class="text-muted mb-0">XA Labs</p>
    </div>

        <?php if ($mensaje_error != "") { ?>
            <div class="alert alert-danger py-2">
                <?php echo $mensaje_error; ?>
            </div>
        <?php } ?>

        <!-- El formulario envía los datos a esta misma página (login.php) por POST -->
        <form method="POST" action="login.php">

            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" placeholder="Ingresá tu usuario" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" placeholder="Ingresá tu contraseña" required>
            </div>

            <button type="submit" class="btn btn-xa w-100">Ingresar</button>

        </form>

        <p class="text-muted text-center mt-3 mb-0" style="font-size: 0.8rem;">
            Usuario de prueba: <strong>seba</strong> / Contraseña: <strong>123</strong>
        </p>

    </div>
</div>

</body>
</html>
