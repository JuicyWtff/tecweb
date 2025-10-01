<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos por Tope de Unidades</title>
</head>
<body>

<?php

    if(isset($_GET['tope'])) { //tope es el numero de unidades
        $tope = $_GET['tope'];
    } else {
        die('<h2>Error: El parámetro "tope" es requerido.</h2></body></html>');
    }

    if (!empty($tope) && is_numeric($tope)) {
        @$link = new mysqli('localhost', 'root', 'Capulin10', 'marketzone');

        if ($link->connect_errno) {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
        }

        $sql = "SELECT * FROM productos WHERE unidades <= {$tope}";
        if ($result = $link->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC); //MYSQLI_ASSOC Significa que cada fila de la base de datos se convertirá en un arreglo asociativo, donde las llaves del arreglo son los nombres de las columnas de tu tabla.
            $result->free();
        } else {
            echo "<h2>Error en la consulta: " . $link->error . "</h2>";
        }
        $link->close();
    } else {
        $rows = null;
    }
    

    echo "<h3>PRODUCTOS</h3>";
    echo "<hr>";

    if(isset($rows) && !empty($rows)) {
        // Si hay productos, se imprime la tabla
        echo '<table border="1">'; 
        echo '  <thead>';
        echo '      <tr>';
        echo '          <th>#</th>';
        echo '          <th>Nombre</th>';
        echo '          <th>Marca</th>';
        echo '          <th>Modelo</th>';
        echo '          <th>Precio</th>';
        echo '          <th>Unidades</th>';
        echo '          <th>Detalles</th>';
        echo '          <th>Imagen</th>';
        echo '      </tr>';
        echo '  </thead>';
        echo '  <tbody>';

        // Se usa foreach para "imprimir" una fila <tr> por cada producto
        foreach($rows as $row) {
            echo '<tr>';
            echo '    <th>' . $row['id'] . '</th>';
            echo '    <td>' . $row['nombre'] . '</td>';
            echo '    <td>' . $row['marca'] . '</td>';
            echo '    <td>' . $row['modelo'] . '</td>';
            echo '    <td>$' .$row['precio'] . '</td>';
            echo '    <td>' . $row['unidades'] . '</td>';
            echo '    <td>' . $row['detalles']. '</td>';
            echo '    <td><img src="' . $row['imagen'] . '" width="100px" alt="Imagen del producto"/></td>';
            echo '</tr>';
        }

        echo '  </tbody>';
        echo '</table>';
    } else {
        // Si no hay productos
        echo '<p>No se encontraron productos con un stock menor o igual a "' . $tope . '".</p>';
    }
?>

</body>
</html>