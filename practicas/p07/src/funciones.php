<?php
    function esMultiploDe5y7($num){
        if ($num%5==0 && $num%7==0){
            echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
        }else{
            echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
        }
    }

    function ImparParImpar(){
        $intentos = [];
        $iteraciones=0;
        $flag=false;

        do{
            $iteraciones++;
            $num1 = rand(1,1000);
            $num2 = rand(1,1000);
            $num3 = rand(1,1000);

            $intentos[]= [$num1,$num2, $num3];

            if(($num1 % 2 != 0) && ($num2 % 2 == 0) && ($num3 % 2 != 0)){
                $flag = true;
            }
        }while(!$flag);

        $resultado = ['iteraciones'=> $iteraciones, 'numerosGenerados'=> $iteraciones*3, 'matriz'=>$intentos];
        return $resultado;
    }
    //EJERCICIO 2
    /* versión while
    function esMultiplodeX($x){
        $flagx = false;
        $cont = 0;
        while(!$flagx){
            $numrand = rand(1,$x*2);
            $cont++;
            if(($numrand % $x) ==0){
                $flagx=true;
                echo '<h3> El número aleatorio: '. $numrand. ' es múltiplo de: '. $x. ' y se encontró en la iteración: '. $cont. '</h3>';
            }
        }
    }
    */
    //version do-while  
    function esMultiplodeX($x){
        $flagx = false;
        $cont = 0;

        do{
            $numrand = rand(1, $x*2);
            $cont++;
            if(($numrand % $x) == 0){
                $flagx=true;
                echo '<h3> El número aleatorio: '. $numrand. ' es múltiplo de: '. $x. ' y se encontró en la iteración: '. $cont. '</h3>';
            }
        }while(!$flagx);
    }

    function abc(){
        $abecedario = [];
        for($i=97; $i<= 122; $i++){
            $abecedario[$i] = chr($i);
        }

        $tabla = "<table border = 1>
                    <thead>
                        <tr>
                            <th>Código ascii (Clave)</th>
                            <th>Letra (valor)</th>
                        </tr>
                    </thead>
                    <tbody>";
        
        foreach($abecedario as $codigo => $letra){
            $tabla .= "<tr>
                        <td>{$codigo}</td>
                        <td>{$letra}</td>
                    </tr>";

        }
        $tabla .= "</tbody>
                </table>";

        return $tabla;
    }

    function verificarBienvenida($edad, $sexo){
        if($sexo == 'femenino' && $edad >=18 && $edad <= 35){
            return "Bienvenida, usted está en el rango de edad permitido.";
        }else{
             return "Lo sentimos, no cumple con los requisitos.";
        }
    }

    function obtenerParqueVehicular() {
        /*Código Duro*/
        $parque = [
            "UBN6338" => [
                "Auto" => ["marca" => "HONDA", "modelo" => 2020, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Alfonzo Esparza", "ciudad" => "Puebla, Pue.", "direccion" => "C.U."]
            ],
            "TLA1234" => [
                "Auto" => ["marca" => "MAZDA", "modelo" => 2019, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Ma. del Consuelo Molina", "ciudad" => "Puebla, Pue.", "direccion" => "97 Oriente"]
            ],
            "ABC5678" => [
                "Auto" => ["marca" => "VW", "modelo" => 2022, "tipo" => "hatchback"],
                "Propietario" => ["nombre" => "Juan Carlos Conde", "ciudad" => "Cholula, Pue.", "direccion" => "Calle Ficticia 123"]
            ]
            
        ];
        return $parque;
    }

    function buscarVehiculoPorMatricula($matricula, $parque) {
        // isset() es una forma súper rápida de verificar si una clave existe en un arreglo asociativo.
        if (isset($parque[$matricula])) {
            return $parque[$matricula];
        } else {
            return null; 
        }
    }

?>