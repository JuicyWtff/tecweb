// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
    listarProductos();
}

function listarProductos() {
    $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        success: function (response) {
            let productos = JSON.parse(response);
            let template = '';
            productos.forEach(producto => {
                let descripcion = '';
                descripcion += '<li>precio: '+producto.precio+'</li>';
                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                descripcion += '<li>marca: '+producto.marca+'</li>';
                descripcion += '<li>detalles: '+producto.detalles+'</li>';
            
                template += `
                    <tr productId="${producto.id}">
                        <td>${producto.id}</td>
                        <td>${producto.nombre}</td>
                        <td><ul>${descripcion}</ul></td>
                        <td>
                            <button class="btn btn-warning btn-sm product-edit">Editar</button>
                            <button class="product-delete btn btn-danger">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#products').html(template);
        }
    });
}

$(document).ready(function(){

    //BUSCAR PRODUCTOS
    $('#product-result').addClass('d-none');
    
    $('#search').keyup(function(e){
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url:'./backend/product-search.php', 
                type:'GET',
                data: {search},
                success: function(response){
                    let products = JSON.parse(response);
                    let template = '';
                    let template_bar = '';
                    products.forEach(producto => {
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="btn btn-warning btn-sm product-edit">Editar</button>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `; 
                        template_bar += `
                            <li>${producto.nombre}</il>
                        `;
                    })
                    $('#container').html(template_bar);
                    $('#products').html(template);
                    $('#product-result').removeClass('d-none');
                } 
            });
        } else {
            listarProductos();
            $('#product-result').addClass('d-none');
        }
    }); 

    //AGREGAR PRODUCTOS
    $('#product-form').submit(function (e) {
        e.preventDefault();

        var productoJsonString = $('#description').val();
        var finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $('#name').val();
        productoJsonString = JSON.stringify(finalJSON, null, 2);

        $.ajax({
            url: './backend/product-add.php',
            type: 'POST',
            data: productoJsonString,
            contentType: 'application/json;charset=UTF-8',
            success: function (response) {
                console.log('Respuesta del servidor:', response);
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $('#container').html(template_bar);
                $('#product-result').removeClass('d-none');
                
                // Actualizar la lista de productos
                listarProductos();

                // Solo resetear el formulario si fue exitoso
                if (respuesta.status === 'success') {
                    $('#product-form').trigger('reset');
                    var JsonString = JSON.stringify(baseJSON, null, 2);
                    $('#description').val(JsonString);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición:', error);
                console.error('Respuesta completa:', xhr.responseText);
            }
        });
    });

    // ELIMINAR PRODUCTOS
    $(document).on('click', '.product-delete', function() {
        if(confirm('¿Estás seguro de eliminar este producto?')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productId');
            $.ajax({
                url: './backend/product-delete.php?id=' + id,
                type: 'GET',
                success: function(response) {
                    let respuesta = JSON.parse(response);
                    let template_bar = `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                    $('#container').html(template_bar);
                    $('#product-result').removeClass('d-none');
                    listarProductos();
                }
            });
        }
    });

    // EDITAR PRODUCTO
    $(document).on("click", ".product-edit", function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr("productId");

        edit = true; // Activar modo edición
        productId = id;

        // Buscar el producto por ID para llenar el formulario
        $.ajax({
            url: "./backend/product-search.php",
            type: "GET",
            data: { search: id },
            dataType: "json",
            success: function (producto) {
                producto = producto[0];
                $("#name").val(producto.nombre);

                // Formatear el JSON para mostrar en el textarea
                let productoFormateado = {
                    precio: parseFloat(producto.precio),
                    unidades: parseInt(producto.unidades, 10),
                    modelo: producto.modelo,
                    marca: producto.marca,
                    detalles: producto.detalles,
                    imagen: producto.imagen
                };

                // Mostrar en el textarea el JSON formateado
                $("#description").val(JSON.stringify(productoFormateado, null, 2));
                $("#productId").val(producto.id);

                // Cambiar texto del submit para indicar edición
                $("#product-form").find("button[type=submit]").text("Actualizar Producto");
            },
        });
    });

});