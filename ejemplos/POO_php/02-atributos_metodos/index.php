<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>02-atributos_metodos</title>
</head>
<body>
    <?php
        require __DIR__.'/menu.php';
        $menu1 = new Menu;

        $menu1->cargar_opcion('https://www.facebook.com', 'Facebook');
        $menu1->cargar_opcion('https://www.instagram.com', 'Instagram');
        $menu1->cargar_opcion('https://www.Google.com', 'Google');

        $menu1->mostrar();
       
    
    ?>
</body>
</html>