<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Producto</title>
    <style>
        body { font-family:Verdana; max-width: 400px; margin: auto; }
        label { display: flex; margin-top: 10px; }
        input[type="text"], input[type="number"], textarea, select { width: 100%; padding: 10px; margin-top: 5px; box-sizing: border-box; border-radius: 5px; }
        input[type="submit"] { margin-top: 20px; padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Registrar Nuevo Producto</h1>
    <form action="set_producto_v2.php" method="post" onsubmit="return validarFormulario();">
        <input type="hidden" id="id_producto" name="id">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" >
        <label for="marca">Marca:</label><br>
        <select id="marca" name="marca">
            <option value="">-- Selecciona una categoría --</option>
            <option value="apple-smartphones">Apple - Smartphones</option>
            <option value="apple-tabletas">Apple - Tabletas</option>
            <option value="apple-computadoras">Apple - Computadoras</option>
            <option value="apple-auriculares">Apple - Auriculares</option>
            <option value="apple-accesorios">Apple - Accesorios</option>
        </select>
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo">
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" min="0.00" step="0.01" >
        <label for="detalles">Detalles:</label>
        <textarea id="detalles" name="detalles" rows="4"></textarea>
        <label for="unidades">Unidades:</label>
        <input type="number" id="unidades" name="unidades" min="0" >
        <label for="imagen">Ruta de la Imagen (ej. img/producto.png):</label>
        <input type="text" id="imagen" name="imagen">
        <input type="submit" value="Registrar Producto">
    </form>
    <script>
        // SCRIPT DE VALIDACIÓN 
        function validarFormulario() {
            const nombre = document.getElementById('nombre').value;
            const marca = document.getElementById('marca').value;
            const modelo = document.getElementById('modelo').value;
            const precio = document.getElementById('precio').value;
            const detalles = document.getElementById('detalles').value;
            const unidades = document.getElementById('unidades').value;
            const imagenInput = document.getElementById('imagen');
            if (nombre.trim() === '') {
                alert('El campo "Nombre" es requerido.');
                return false;
            }
            if (nombre.length > 100) {
                alert('El nombre no puede tener más de 100 caracteres.');
                return false;
            }
            if (marca === '') {
                alert('Debes seleccionar una marca.');
                return false;
            }
            if (modelo.trim() === '') {
                alert('El campo "Modelo" es requerido.');
                return false;
            }
            if (modelo.length > 25) {
                alert('El modelo no puede tener más de 25 caracteres.');
                return false;
            }
            const regexAlfanumerico = /^[a-zA-Z0-9\s-]+$/;
            if (!regexAlfanumerico.test(modelo)) {
                alert('El modelo solo puede contener letras, números, espacios y guiones.');
                return false;
            }
            if (precio.trim() === '') {
                alert('El campo "Precio" es requerido.');
                return false;
            }
            if (parseFloat(precio) <= 99.99) {
                alert('El precio debe ser mayor a 99.99.');
                return false;
            }
            if (detalles.length > 250) {
                alert('Los detalles no pueden exceder los 250 caracteres.');
                return false;
            }
            if (unidades.trim() === '') {
                alert('El campo "Unidades" es requerido.');
                return false;
            }
            if (parseInt(unidades) < 0 || isNaN(parseInt(unidades))) {
                alert('Las unidades deben ser un número mayor o igual a 0.');
                return false;
            }
            if (imagenInput.value.trim() === '') {
                imagenInput.value = 'img/default.png';
            }
            return true;
        }
    </script>
    <script>
        // SCRIPT PARA RELLENAR EL FORMULARIO (CORREGIDO)
        window.onload = function() {
            const params = new URLSearchParams(window.location.search);
            const idProducto = params.get('id');

            // Solo si existe un 'id' en la URL, cambiamos a modo "Modificar"
            if (idProducto) {
                document.getElementById('id_producto').value = idProducto;
                document.getElementById('nombre').value = params.get('nombre');
                document.getElementById('marca').value = params.get('marca');
                document.getElementById('modelo').value = params.get('modelo');
                document.getElementById('precio').value = params.get('precio');
                document.getElementById('detalles').value = params.get('detalles');
                document.getElementById('unidades').value = params.get('unidades');
                document.getElementById('imagen').value = params.get('imagen');
                
                document.querySelector('h1').textContent = 'Modificar Producto';
                document.querySelector('input[type="submit"]').value = 'Actualizar Producto';
                document.querySelector('form').action = 'update_producto.php';
            }
        };
    </script>
</body>
</html>