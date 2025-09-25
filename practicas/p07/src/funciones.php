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
?>