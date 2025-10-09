<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
    // SE ELIMINÓ EL BLOQUE DE CÓDIGO QUE BUSCABA EL PARÁMETRO 'tope'

	/** SE CREA EL OBJETO DE CONEXION */
	@$link = new mysqli('localhost', 'root', 'Capulin10', 'marketzone');
	/** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */

	/** comprobar la conexión */
	if ($link->connect_errno) 
	{
		die('Falló la conexión: '.$link->connect_error.'<br/>');
	}

	/** Crear una tabla que no devuelve un conjunto de resultados */
	// SE MODIFICÓ LA CONSULTA SQL PARA FILTRAR POR la columna 'eliminado'
	if ( $result = $link->query("SELECT * FROM productos WHERE eliminado = 0") ) 
	{
		/** Se extraen las tuplas obtenidas de la consulta */
		$row = $result->fetch_all(MYSQLI_ASSOC);

		/** útil para liberar memoria asociada a un resultado con demasiada información */
		$result->free();
	}

	$link->close();
?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Productos Vigentes</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
					</tr>
				</thead>
				<tbody>
					<?php foreach($row as $value) : ?>
					<tr>
						<th scope="row"><?= $value['id'] ?></th>
						<td><?= $value['nombre'] ?></td>
						<td><?= $value['marca'] ?></td>
						<td><?= $value['modelo'] ?></td>
						<td><?= $value['precio'] ?></td>
						<td><?= $value['unidades'] ?></td>
						<td><?= $value['detalles'] ?></td>
						<td><img src="<?= $value['imagen'] ?>" width="100px"></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php else : ?>
			<p>No hay productos vigentes para mostrar.</p>
		<?php endif; ?>
	</body>
</html>