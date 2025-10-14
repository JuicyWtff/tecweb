<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos por Tope de Unidades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script>
        function enviarParaModificar() {
            var rowId = event.target.parentNode.parentNode.id;
            var data = document.getElementById(rowId).querySelectorAll(".row-data");

            var id       = rowId;
            var nombre   = data[0].innerHTML;
            var marca    = data[1].innerHTML;
            var modelo   = data[2].innerHTML;
            var precio   = data[3].innerHTML.replace('$', ''); // Quitamos el símbolo de peso
            var unidades = data[4].innerHTML;
            var detalles = data[5].innerHTML;

            var urlFormulario = "formulario_productos_v2.php";
            var params = `?id=${encodeURIComponent(id)}` +
                         `&nombre=${encodeURIComponent(nombre)}` +
                         `&marca=${encodeURIComponent(marca)}` +
                         `&modelo=${encodeURIComponent(modelo)}` +
                         `&precio=${encodeURIComponent(precio)}` +
                         `&unidades=${encodeURIComponent(unidades)}` +
                         `&detalles=${encodeURIComponent(detalles)}`;

            window.location.href = urlFormulario + params;
        }
    </script>
</head>
<body>

<?php
    if(isset($_GET['tope'])) {
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
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            echo "<h2>Error en la consulta: " . $link->error . "</h2>";
        }
        $link->close();
    } else {
        $rows = null;
    }
    
    echo "<h3>PRODUCTOS CON STOCK <= A " . $tope . "</h3>";
    echo "<hr>";

    if(isset($rows) && !empty($rows)) {
        echo '<table class="table table-striped">'; 
        echo '  <thead class="thead-dark">';
        echo '      <tr>';
        echo '          <th>#</th>';
        echo '          <th>Nombre</th>';
        echo '          <th>Marca</th>';
        echo '          <th>Modelo</th>';
        echo '          <th>Precio</th>';
        echo '          <th>Unidades</th>';
        echo '          <th>Detalles</th>';
        echo '          <th>Imagen</th>';
        echo '          <th>Modificar</th>';
        echo '      </tr>';
        echo '  </thead>';
        echo '  <tbody>';

        foreach($rows as $row) {
            echo '<tr id="' . $row['id'] . '">';
            echo '    <th>' . $row['id'] . '</th>';
            echo '    <td class="row-data">' . $row['nombre'] . '</td>';
            echo '    <td class="row-data">' . $row['marca'] . '</td>';
            echo '    <td class="row-data">' . $row['modelo'] . '</td>';
            echo '    <td class="row-data">$' . $row['precio'] . '</td>';
            echo '    <td class="row-data">' . $row['unidades'] . '</td>';
            echo '    <td class="row-data">' . $row['detalles']. '</td>';
            echo '    <td><img src="' . $row['imagen'] . '" width="100px" alt="Imagen del producto"/></td>';
            echo '    <td><input type="button" value="Modificar" onclick="enviarParaModificar()" /></td>';
            echo '</tr>';
        }

        echo '  </tbody>';
        echo '</table>';
    } else {
        echo '<p>No se encontraron productos con un stock menor o igual a "' . $tope. '".</p>';
    }
?>

</body>
</html>