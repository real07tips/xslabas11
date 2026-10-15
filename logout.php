<?php
session_start();

// session_unset() borra todas las variables de sesión
session_unset();

// session_destroy() termina la sesión por completo
session_destroy();

// Mandamos al usuario de vuelta al login
header("Location: login.php");
exit;
?>
