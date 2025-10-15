<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['search']) ) {
        $searchTerm = $_POST['search'];

        //término de búsqueda
        $likeTerm = "%{searchTerm}%";
        
        //SE REALIZA EL QUERY DE BUSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $query = "SELECT * FROM productos WHERE nombre LIKE '%{$likeTerm}%' OR marca LIKE '%{$likeTerm}%' OR detalles LIKE '%{$likeTerm}%'";

        if($result = $conexion->query($query)){
            //ITERAR SOBRE LOS RESULTADOS ENCONTRADOS
            while($row = $result->fetch_assoc()){
                $product = array();
                foreach($row as $key => $value){
                    $product[$key] = utf8_encode($value);
                }
                $data[]=$product;
            }
            $result -> free();
        }else{
            die('Query Error: '. mysqli_error($conexion));
        }
        $conexión->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>