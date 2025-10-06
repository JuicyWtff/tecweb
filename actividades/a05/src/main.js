
function getDatos()
{
    var nombre = prompt("Nombre: ", "");

    var edad = prompt("Edad: ", 0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3> Nombre: '+nombre+'</h3>';

    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3> Edad: '+edad+'</h3>';
}

function holamundo(){
    document.writeln("<h3>Hola Mundo!</h3>");
    document.writeln('<a href="index.html">Regresar</a>');
}

function variables1(){
    let nombre = prompt("Nombre :","");
    let edad = prompt("Edad :",0);
    let altura = prompt("Altura: ","");
    let married = confirm("¿Estás Casado?");

    let div1 = document.getElementById("nombre1");
    div1.innerHTML = "<h3> Nombre: "+nombre+"</h3>";
    let div2 = document.getElementById("edad1");
    div2.innerHTML = "<h3> Edad: "+edad+"</h3>";
    let div3 = document.getElementById("altura");
    div3.innerHTML = "<h3> Altura: "+altura+"</h3>";
    let div4 = document.getElementById("casado");
    if(!married){
        div4.innerHTML = "<h3>Usted no está casado</h3>";
    }else{
        div4.innerHTML = "<h3>Usted está casado</h3>";
    }
    
}

function variables2(){
    let nombre = prompt("Nombre: ", "");
    let edad =  prompt("Edad: ", 0);
    let div1 = document.getElementById("Res1");
    div1.innerHTML = "<h3> Hola "+nombre+" así que tienes: "+edad+" años";

}

function condicion1(){
    let valor1, valor2, suma, producto;
    valor1 = prompt("Introducir primer número:","");
    valor2 = prompt("Introducir segundo número:","");
    suma = parseInt(valor1)+parseInt(valor2);
    producto =  parseInt(valor1)*parseInt(valor2);
    let div1 = document.getElementById("Res2");
    div1.innerHTML= "<h3>La suma es: "+suma+"<br> Y el producto es: "+producto+"</h3>";
}

function condicion2(){
    let nombre, nota,div1;
    nombre = prompt("Ingresa tu nombre: ","");
    nota =  prompt("Ingresa tu nota: ","");
    div1 =  document.getElementById("Res3");
    if(nota>=4){
        div1.innerHTML = "<h3>"+nombre+" usted está aprobado con: "+nota+" de calificación.</h3>";
    }else{
        div1.innerHTML = "<h3>"+nombre+" usted está reprobado con: "+nota+" de calificación.</h3>";
    }
}

function condicion3(){
    let x,y,div1;

    x = prompt("Ingrese el primer número: ",0);
    y = prompt("Ingrese el segundo número: ",0);
    x = parseInt(x);
    y = parseInt(y);
    div1 = document.getElementById("Res4");
    if(x>y){
        div1.innerHTML = "<h3>El primer número es mayor </h3>";
    }else{
        div1.innerHTML = "<h3>El segundo número es mayor </h3>";
    }
}

function condicion4(){
    let nota1,nota2,nota3,promedio,div1;

    nota1 =  prompt("Ingresa la primer nota: ", "");
    nota2 =  prompt("Ingresa la segunda nota: ", "");
    nota3 =  prompt("Ingresa la tercer nota: ", "");

    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    promedio = (nota1+nota2+nota3) / 3;
    div1 =  document.getElementById("Res5");

    if(promedio>=7){
        div1.innerHTML = "<h3>Aprobado</h3>";
    }else{
        if(promedio>=4){
            div1.innerHTML = "<h3>Regular</h3>";
        }else{
            div1.innerHTML = "<h3>Reprobado</h3>";
        }
    }
}

function condicion5(){
    let valor, div1;
    valor = prompt("Ingresa un valor comprendido entre 1 y 5: ","");
    div1 = document.getElementById("Res6");
    valor = parseInt(valor);
    switch(valor){
        case 1: div1.innerHTML = "<h3>Uno</h3>";
            break;
        case 2:div1.innerHTML = "<h3>Dos</h3>";
            break;
        case 3:div1.innerHTML = "<h3>Tres</h3>";
            break;
        case 4:div1.innerHTML = "<h3>Cuatro</h3>";
            break;
        case 5:div1.innerHTML = "<h3>Cinco</h3>";
            break;
        default:div1.innerHTML = "<h3>Debe ingresar un valor comprendido entre 1 y 5</h3>";
    }
}

function condicion6(){
    let color, div1;
    color =  prompt("Ingresa el color con el que quieras pintar el fondo de la ventana (rojo, verde, azul)","");
    div1 =  document.getElementById("Res7");
    switch(color){
        case 'rojo': div1 = document.bgColor = "red";
            break;
        case 'verde': div1 = document.bgColor = "green";
            break;
        case 'azul': div1 = document.bgColor = "blue";
            break;
        default: div1.innerHTML = "<h3>Ingresa un color!</h3>";
    }
}

function repeticion1(){
    let x = 1;
    let div1 = document.getElementById("Res8");
    let resultado = "";

    while(x <= 100){
        resultado += "<h4>" + x + "</h4><br>";
        x++;
    }

    div1.innerHTML = resultado;
}

function repeticion2(){
    let x, suma, valor, div1;
    x = 1;
    suma = 0;

    while(x<=5){
        valor = prompt("Ingresa el valor: ","");
        valor = parseInt(valor);
        suma = suma + valor;
        x++;
    }

    div1 = document.getElementById("Res9");
    div1.innerHTML = "<h3>La suma de los valores es: "+suma+"</h3><br>";
}

function repeticion3(){
    let valor, div1;
    div1 = document.getElementById("Res10");
    do {
        valor = prompt("Ingresa un valor entre 0 y 999: ", "");
        valor = parseInt(valor);

        if (valor != 0) {
            if (valor < 10) {
                div1.innerHTML = "<h3>Tiene 1 dígito</h3>";
            } else if (valor < 100) {
                div1.innerHTML = "<h3>Tiene 2 dígitos</h3>";
            } else {
                div1.innerHTML = "<h3>Tiene 3 dígitos</h3>";
            }
        }
    } while (valor != 0);
}

function repeticion4(){
    let f, div1;
    div1 = document.getElementById("Res11");
    for(f = 1; f<=10; f++){
        div1.innerHTML = f+" ";
    }
}

function funciones1(){
    let div1, div2, div3;
    div1 = document.getElementById("Res12");
    div2 = document.getElementById("Res13");
    div3 = document.getElementById("Res14");
    div1.innerHTML = "Cuidado<br>ingresa tu documento correctamente<br>";
    div2.innerHTML = "Cuidado<br>ingresa tu documento correctamente<br>";
    div3.innerHTML = "Cuidado<br>ingresa tu documento correctamente<br>";
}

function funciones2(){
    let div1, div2, div3;
    div1 = document.getElementById("Res15");
    div2 = document.getElementById("Res16");
    div3 = document.getElementById("Res17");
    div1.innerHTML = "Cuidado<br>ingresa tu documento correctamente<br>";
    div2.innerHTML = "Cuidado<br>ingresa tu documento correctamente<br>";
    div3.innerHTML = "Cuidado<br>ingresa tu documento correctamente<br>";
}

function funciones3(){
    let valor1, valor2, div1, inicio;
    div1 = document.getElementById("Res18");
    valor1 = prompt("Ingresa el valor inferior: ","");
    valor1 = parseInt(valor1);
    valor2 = prompt("Ingresa el valor superior: ","");
    valor2 = parseInt(valor2);

    for(inicio = valor1; inicio<=valor2; inicio++){
        div1.innerHTML = inicio + " ";
    }
}

function funciones4(){
    let valor, div1;
    valor = prompt("Ingresa un valor entre 1 y 5","");
    valor = parseInt(valor);
    div1 = document.getElementById("Res19");

    if(valor == 1){
        div1.innerHTML = "<h3>Uno</h3>";
    }else if(valor == 2){
        div1.innerHTML = "<h3>Dos</h3>";
    }else if(valor == 3){
        div1.innerHTML = "<h3>Tres</h3>";
    }else if(valor == 4){
        div1.innerHTML = "<h3>Cuatro</h3>";
    }else if(valor == 5){
        div1.innerHTML = "<h3>Cinco</h3>";
    }else{
        div1.innerHTML = "<h3>Valor incorrecto</h3>";
    }
}

function funciones5(){
    let valor, div1;
    valor = prompt("Ingresa un valor entre 1 y 5","");
    valor = parseInt(valor);
    div1 = document.getElementById("Res20");

    switch(valor){
        case 1: div1.innerHTML = "<h3>Uno</h3>";
            break;
        case 2: div1.innerHTML = "<h3>Dos</h3>";
            break;
        case 3: div1.innerHTML = "<h3>Tres</h3>";
            break;
        case 4:  div1.innerHTML = "<h3>Cuatro</h3>";
            break;
        case 5: div1.innerHTML = "<h3>Cinco</h3>";
            break;
        default: div1.innerHTML = "<h3>Valor incorrecto</h3>";

    }
}