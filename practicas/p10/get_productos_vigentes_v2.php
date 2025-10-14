<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
    @$link = new mysqli('localhost', 'root', 'Capulin10', 'marketzone');

    if ($link->connect_errno) {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
    }

    if ( $result = $link->query("SELECT * FROM productos WHERE eliminado = 0") ) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    }

    $link->close();
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Productos Vigentes</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <script>
            function enviarParaModificar() {
                // Se obtiene el id de la fila donde está el botón presionado 
                var rowId = event.target.parentNode.parentNode.id;

                // Se obtienen los datos de la fila que tienen la clase "row-data" 
                var data = document.getElementById(rowId).querySelectorAll(".row-data");

                //Se extrae el texto de cada celda
                var id       = rowId; // El ID de la fila es el ID del producto
                var nombre   = data[0].innerHTML;
                var marca    = data[1].innerHTML;
                var modelo   = data[2].innerHTML;
                var precio   = data[3].innerHTML;
                var unidades = data[4].innerHTML;
                var detalles = data[5].innerHTML;

                
                alert(`Datos capturados:\nID: ${id}\nNombre: ${nombre}`);

                // Se construye la URL y se redirige (como lo hace send2form)
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
        <h3>PRODUCTOS VIGENTES</h3>
        <br/>
        <?php if( !empty($row) ) : ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($row as $value) : ?>
                        <tr id="<?= $value['id'] ?>">
                            <th scope="row"><?= $value['id'] ?></th>
                            <td class="row-data"><?= $value['nombre'] ?></td>
                            <td class="row-data"><?= $value['marca'] ?></td>
                            <td class="row-data"><?= $value['modelo'] ?></td>
                            <td class="row-data"><?= $value['precio'] ?></td>
                            <td class="row-data"><?= $value['unidades'] ?></td>
                            <td class="row-data"><?= $value['detalles'] ?></td>
                            <td><img src="<?= $value['imagen'] ?>" width="100px"></td>
                            <td><input type="button" value="Modificar" onclick="enviarParaModificar()"/></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No hay productos vigentes para mostrar.</p>
        <?php endif; ?>
    </body>
</html>