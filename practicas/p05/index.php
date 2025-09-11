<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

    <h2>Ejercicio 2</h2>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        echo '<h4>Estado inicial</h4>';
        echo '<pre>'; var_dump($a,$b,$c); echo '</pre>';

        $a = "PHP server";
        $b = &$a;

        echo '<h4>Después de reasignar</h4>';
        echo '<pre>'; var_dump($a,$b,$c); echo '</pre>';
        echo "<p>Al reasignar \$a, también cambió \$c porque era referencia; ahora \$b también referencia a \$a.</p>";
        unset($a,$b,$c);
    ?>

    <h2>Ejercicio 3</h2>
    <?php
        $a="PHP5"; $z[]=&$a;
        echo "<pre>"; var_dump($a,$z); echo "</pre>";
        $b="5a version de PHP";
        echo "<pre>"; var_dump($b); echo "</pre>";
        $c=$b*10;
        echo "<pre>"; var_dump($c); echo "</pre>";
        $a.=$b;
        echo "<pre>"; var_dump($a,$z); echo "</pre>";
        $b*=$c;
        echo "<pre>"; var_dump($b); echo "</pre>";
        $z[0]="MySQL";
        echo "<pre>"; var_dump($a,$z); echo "</pre>";
        
    ?>

    <h2>Ejercicio 4</h2>
    <?php
        echo '<pre>';
        echo 'GLOBALS["a"]: '; var_dump($GLOBALS['a']);
        echo 'GLOBALS["b"]: '; var_dump($GLOBALS['b']);
        echo 'GLOBALS["c"]: '; var_dump($GLOBALS['c']);
        echo 'GLOBALS["z"]: '; print_r($GLOBALS['z']);
        echo '</pre>';

        unset($a, $b, $c, $z);
    ?>

    <h2>Ejercicio 5</h2>
    <?php
        $a="7 personas";
        $b=(integer)$a;
        $a="9E3";
        $c=(double)$a;
        echo "<pre>"; var_dump($a,$b,$c); echo "</pre>";
        unset($a,$b,$c);
    ?>

    <h2>Ejercicio 6</h2>
    <?php
        $a="0"; $b="TRUE"; $c=FALSE; $d=($a OR $b); $e=($a AND $c); $f=($a XOR $b);
        var_dump($a,$b,$c,$d,$e,$f);
        echo "<p>Valores legibles: c=".var_export($c,true)." e=".var_export($e,true)."</p>";
        unset($a,$b,$c,$d,$e,$f);
    ?>

    <h2>Ejercicio 7</h2>
    <?php
        echo "<ul>";
        echo "<li>Versión de PHP: ".$_SERVER['SERVER_SOFTWARE']."</li>";
        echo "<li>Nombre del SO servidor: ".php_uname()."</li>";
        echo "<li>Idioma del navegador: ".$_SERVER['HTTP_ACCEPT_LANGUAGE']."</li>";
        echo "</ul>";
    ?>
</body>
</html>