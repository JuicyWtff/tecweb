<?php
    require_once 'src/funciones.php';
    $parque = obtenerParqueVehicular();
    function mostrarVehiculo($matricula, $datosVehiculo) {
        echo "<h3>Resultados para la Matrícula: {$matricula}</h3>";
        echo "<ul>";
        echo "<li><strong>Marca:</strong> " . $datosVehiculo['Auto']['marca'] . "</li>";
        echo "<li><strong>Modelo:</strong> " . $datosVehiculo['Auto']['modelo'] . "</li>";
        echo "<li><strong>Tipo:</strong> " . $datosVehiculo['Auto']['tipo'] . "</li>";
        echo "<li><strong>Propietario:</strong> " . $datosVehiculo['Propietario']['nombre'] . "</li>";
        echo "<li><strong>Ciudad:</strong> " . $datosVehiculo['Propietario']['ciudad'] . "</li>";
        echo "<li><strong>Dirección:</strong> " . $datosVehiculo['Propietario']['direccion'] . "</li>";
        echo "</ul>";
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Resultados de la Consulta</title>
</head>
<body>
    <h1>Consulta de Vehículos</h1>

    <?php
    if (isset($_POST['accion'])) {

        if ($_POST['accion'] == 'Buscar por Matrícula') {
            if (!empty($_POST['matricula'])) {
                $matriculaBuscada = strtoupper($_POST['matricula']); // Convertir a mayúsculas
                $vehiculoEncontrado = buscarVehiculoPorMatricula($matriculaBuscada, $parque);

                if ($vehiculoEncontrado) {
                    mostrarVehiculo($matriculaBuscada, $vehiculoEncontrado);
                } else {
                    echo "<p><strong>Error:</strong> No se encontró ningún vehículo con la matrícula '{$matriculaBuscada}'.</p>";
                }
            } else {
                echo "<p><strong>Error:</strong> Por favor, ingrese una matrícula para buscar.</p>";
            }
        }
 
        elseif ($_POST['accion'] == 'Mostrar Todos') {
            echo "<h4>Estructura General del Arreglo (print_r):</h4>";
            echo "<pre>";
            print_r($parque);
            echo "</pre>";
        }
    }
    ?>

    <br />
    <a href="index.php">Realizar otra consulta</a>
</body>
</html>