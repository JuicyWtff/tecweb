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
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
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
    $('#product-result').hide();
    $('#search').keyup(function(e){
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url:'./backend/product-search.php', 
                type:'GET',
                data: {search},
                success: function(response){
                    //Imprimir el resultado
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
                    $('#product-result').show();
                } 
            });
        }else{
            listarProductos();
        }
    }); 

});