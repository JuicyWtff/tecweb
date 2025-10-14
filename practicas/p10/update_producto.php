<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualización de Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body { font-family: Verdana; padding: 40px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container">
<?php
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $detalles = $_POST['detalles'];
    $unidades = $_POST['unidades'];
    $imagen = $_POST['imagen'];

    @$link = new mysqli('localhost', 'root', 'Capulin10', 'marketzone');

    if ($link->connect_errno) {
        die('<h2>Falló la conexión a la base de datos:</h2>' . $link->connect_error);
    }

    $sql = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, precio = ?, detalles = ?, unidades = ?, imagen = ? WHERE id = ?";
    
    if ($stmt = $link->prepare($sql)) {
        $stmt->bind_param("sssdsisi", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen, $id);
        
        if ($stmt->execute()) {
            echo '<h2>¡Éxito!</h2>';
            echo '<p>El producto ha sido actualizado correctamente en la base de datos.</p>';
        } else {
            echo '<h2 class="text-danger">Error</h2>';
            echo '<p>No se pudo actualizar el registro. Por favor, intente de nuevo.</p>';
            echo '<p>Error: ' . $stmt->error . '</p>';
        }
        $stmt->close();
    } else {
        echo '<h2 class="text-danger">Error</h2>';
        echo '<p>No se pudo preparar la consulta para la base de datos.</p>';
        echo '<p>Error: ' . $link->error . '</p>';
    }
    
    $link->close();
?>
        <a href="get_productos_vigentes_v2.php" >Volver a la lista de productos</a>
    </div>
</body>
</html>