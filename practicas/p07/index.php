<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        require_once('src/funciones.php');
        if(isset($_GET['numero'])){
          $num=$_GET['numero'];
          echo esMultiploDe5y7($num);     
        }
    ?>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p07/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br/>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>
    <br/>
    <h2>Ejercicio 2</h2>
    <p>Generación repetitiva de 3 números aleatorios hasta obtener la secuencia: impar, par, impar.</p>
    <?php
        $resultado = ImparParImpar();
        echo "<h3>Se obtuvieron: ". $resultado['numerosGenerados']. " números en " . $resultado['iteraciones']. " iteraciones.</h3>";
        echo '<pre>';
            foreach($resultado['matriz'] as $indice => $fila){
                echo 'Intento' . ($indice+1) . ': ';
                foreach($fila as $numero){
                    echo $numero.' ';
                }
                echo "\n";
            }
        echo '</pre>';

    ?>
    <br/>
    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente, pero que además sea múltiplo de un número dado.</p>
    <?php
        require_once('src/funciones.php');
        if(isset($_GET['x'])){
          $x=$_GET['x'];
          echo esMultiplodeX($x);     
        }
    ?>

    <br/>
    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’ a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner el valor en cada índice. </p>
    <?php
        require_once('src/funciones.php');
        echo abc();
    ?>

    <br/>
    <h2>Ejercicio 5</h2>
    <p>Preguntar mediante un formulario edad y sexo y si es mujer cuya edad oscile entre los 18 y 35 años mostrar un mensaje de bienvenida apropiado, en caso contrario deberá devolverse otro mensaje indicando el error.</p>
    <form action = "respuestaEj5.php" method = "post">
        <label for="edad"><strong>Edad:</strong></label>
        <input type="number" id="edad" name="edad" required="required"/>
        <br>
        <label for="sexo"><strong>Sexo:</strong></label>
        <input type="radio" id="femenino" name = "sexo" value="femenino" required="required"/>
        <label for="femenino">Femenino</label>
        <input type= "radio" id="masculino" name="sexo" value="masculino" required="required"/>
        <label for="masculino">Masculino</label>
        <br/>
        <input type="submit" value="verificar"/>
    </form>

    <br/>
    <h2>Ejercicio 6</h2>
    <p> </p>
</body>
</html>