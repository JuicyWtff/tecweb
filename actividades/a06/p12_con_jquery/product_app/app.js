$(document).ready(function(){
    let edit = false;

    $('#product-result').hide();
    listarProductos();

    // Funciones de validación
    function showValidationError(fieldId, message) {
        $(`#${fieldId}-error`).text(message).show();
    }

    function hideValidationError(fieldId) {
        $(`#${fieldId}-error`).hide();
    }
    
    function hideAsyncNameError() {
        $('#name-async-error').hide();
    }

    function validateRequired(fieldId, message) {
        const value = $(`#${fieldId}`).val().trim();
        if (value === '') {
            showValidationError(fieldId, message);
            return false;
        }
        hideValidationError(fieldId);
        return true;
    }

    function validatePositiveNumber(fieldId, message) {
        const value = parseFloat($(`#${fieldId}`).val());
        if (isNaN(value) || value <= 0) {
            showValidationError(fieldId, message);
            return false;
        }
        hideValidationError(fieldId);
        return true;
    }

    function validateInteger(fieldId, message) {
        const value = parseInt($(`#${fieldId}`).val(), 10);
        if (isNaN(value) || value <= 0 || parseFloat($(`#${fieldId}`).val()) !== value) {
            showValidationError(fieldId, message);
            return false;
        }
        hideValidationError(fieldId);
        return true;
    }

    function validateForm() {
        const isNameValid = validateRequired('name', 'El nombre es requerido.');
        const isMarcaValid = validateRequired('marca', 'La marca es requerida.');
        const isModeloValid = validateRequired('modelo', 'El modelo es requerido.');
        const isPrecioValid = validatePositiveNumber('precio', 'El precio debe ser un número positivo.');
        const isUnidadesValid = validateInteger('unidades', 'Las unidades deben ser un entero positivo.');
        const isDetallesValid = validateRequired('detalles', 'Los detalles son requeridos.');
        const isImagenValid = validateRequired('imagen', 'La URL de la imagen es requerida.');

        return isNameValid && isMarcaValid && isModeloValid && isPrecioValid && isUnidadesValid && isDetallesValid && isImagenValid;
    }

    // Eventos 'blur' para validación
    $('#name').blur(() => validateRequired('name', 'El nombre es requerido.'));
    $('#marca').blur(() => validateRequired('marca', 'La marca es requerida.'));
    $('#modelo').blur(() => validateRequired('modelo', 'El modelo es requerido.'));
    $('#detalles').blur(() => validateRequired('detalles', 'Los detalles son requeridos.'));
    $('#imagen').blur(() => validateRequired('imagen', 'La URL de la imagen es requerida.'));
    $('#precio').blur(() => validatePositiveNumber('precio', 'El precio debe ser un número positivo.'));
    $('#unidades').blur(() => validateInteger('unidades', 'Las unidades deben ser un entero positivo.'));

    // Validación asíncrona de nombre
    $('#name').keyup(function() {
        const name = $(this).val();
        if (name.length > 2) { 
            const id = $('#productId').val();

            $.post('./backend/product-check-name.php', { name, id }, (response) => {
                const data = JSON.parse(response);
                if (data.existe) {
                    $('#name-async-error').text('Ese nombre de producto ya existe.').show();
                } else {
                    $('#name-async-error').hide();
                }
            });
        } else {
            $('#name-async-error').hide();
        }
    });


    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        const isAsyncError = $('#name-async-error').is(':visible');
        if (!validateForm() || isAsyncError) {
            alert("Por favor, corrige los errores en el formulario.");
            return; 
        }

        const postData = {
            nombre: $('#name').val(),
            marca: $('#marca').val(),
            modelo: $('#modelo').val(),
            precio: $('#precio').val(),
            unidades: $('#unidades').val(),
            detalles: $('#detalles').val(),
            imagen: $('#imagen').val(),
            id: $('#productId').val()
        };

        /**
         * AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
         * --> EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
         **/

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.post(url, postData, (response) => {
            //console.log(response);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE REINICIA EL FORMULARIO
            $('#product-form').trigger('reset');
            $('.validation-error').hide();

            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', function(e) {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this).closest('tr');
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', function(e) {
        e.preventDefault();
        const element = $(this).closest('tr');
        const id = $(element).attr('productId');

        $.post('./backend/product-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            $('#marca').val(product.marca);
            $('#modelo').val(product.modelo);
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#productId').val(product.id);
            
            $('.validation-error').hide();

            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
    });    
});