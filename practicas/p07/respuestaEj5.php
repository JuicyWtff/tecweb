<?php
    require_once 'src/funciones.php';

    $mensaje = "Error: No se recibieron los datos del formulario.";

    if (isset($_POST['edad']) && isset($_POST['sexo'])) {
        $mensaje = verificarBienvenida($_POST['edad'], $_POST['sexo']);
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Resultado del Formulario</title>
</head>
<body>
    <h1>Resultado de la Verificación</h1>
    <p><?php echo $mensaje; ?></p>
    <a href="index.php">Volver al formulario</a>
</body>
</html>