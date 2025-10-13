<?php
/*Este script recibe datos de un formulario HTML, valida que el producto no exista en la base de datos y, si no existe, lo inserta.*/

// RECIBIR DATOS DEL FORMULARIO
// Se utiliza el operador de fusión de null (??) para evitar errores si un campo no se envía.
$nombre = $_POST['nombre'] ?? '';
$marca = $_POST['marca'] ?? '';
$modelo = $_POST['modelo'] ?? '';
$precio = (float)($_POST['precio'] ?? 0.0); //se verifica que el dato sea flotante
$detalles = $_POST['detalles'] ?? '';
$unidades = (int)($_POST['unidades'] ?? 0); //se verifica que el dato sea entero
$imagen = $_POST['imagen'] ?? 'img/default.png';

// CONECTAR A LA BASE DE DATOS
@$link = new mysqli('localhost', 'root', 'Capulin10', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error); //si hay un error al conectar; die termina el script
}

//VALIDAR SI EL PRODUCTO YA EXISTE
$sql_check = "SELECT id FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";

/*Consulta */
if ($result_check = $link->query($sql_check)) {
    // Se verifica si la consulta devolvió alguna fila
    if ($result_check->num_rows > 0) {
        echo 'Error: El producto con el mismo nombre, marca y modelo ya existe en la base de datos.';
    } else {
        // INSERTAR EL NUEVO PRODUCTO SI NO EXISTE 
        // Las variables numéricas ($precio, $unidades, $eliminado) no necesitan comillas.
        $sql_insert = "INSERT INTO productos(nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

        // Se ejecuta la inserción 
        if ($link->query($sql_insert)) {
            echo 'Producto insertado exitosamente con id: ' . $link->insert_id;
        } else {
            echo 'Error al insertar el producto.';
        }
    }
    // Liberar el resultado de la memoria
    $result_check->free();
} else {
    echo "Error al ejecutar la consulta de verificación: " . $link->error;
}


// CERRAR LA CONEXIÓN
$link->close();
?>