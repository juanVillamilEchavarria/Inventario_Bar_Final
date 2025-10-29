// inicio sesion validacion y mensaje
const datos = {
    usuario: "",
    contrasena: ""
}
const usuario = document.querySelector ("#usuario")
const contrasena = document.querySelector ("#contrasena")
const formulario = document.querySelector (".contenedor-formulario")
const botonEnvio = document.querySelector ("#botonInicio")
const backBody= document.querySelector("body")
botonEnvio.addEventListener("click", envio);


function mensaje (aviso){
   
    // crear mensaje 1
    const mensaje = document.createElement("P");
    mensaje.textContent= aviso;
    mensaje.classList.add("avisoFormulario");


    // crear mensaje 2
    const mensajeError = document.createElement("P");
    mensajeError.textContent= "ADVERTENCIA:";
    mensajeError.classList.add("errorFormulario");

    // crear icono
    const mensajeIcono = document.createElement("SVG");
    mensajeIcono.innerHTML= `<svg  xmlns="http://www.w3.org/2000/svg"  width="74"  height="74"  viewBox="0 0 24 24"  fill="none"  stroke="#b61111"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>`;
    mensajeIcono.classList.add("iconoFormulario");

    // Crear boton
    const mensajeBoton = document.createElement("BUTTON");
    mensajeBoton.textContent="Cerrar";
    mensajeBoton.classList.add("botonFormulario");
    
    
    // crear div hijo el que tiene el mensaje
    const divMensaje= document.createElement("DIV");
    divMensaje.classList.add("divMensaje");
    divMensaje.appendChild(mensajeIcono);
     divMensaje.appendChild(mensajeError);
    divMensaje.appendChild(mensaje);
    divMensaje.appendChild(mensajeBoton);
    
   


    // crear div Global
    const divError= document.createElement("DIV");  
    divError.classList.add("divError");
    divError.appendChild(divMensaje);

    

    // asignar hijos
    backBody.classList.add("backError");
    backBody.appendChild(divError);
    mensajeBoton.onclick=cerrarMensaje;




}

function cerrarMensaje(){
    const divMensaje = document.querySelector(".divMensaje");
    const divError = document.querySelector(".divError");
    if (divMensaje && divError) {
        divMensaje.remove();
        divError.remove();
    }
    divMensaje?.remove();
    divError?.remove();
    
}

function correcto(){
   window.location.href = "productos.php";
}

function resultado(e){
    // console.log(e.target.value);//el .target es para acceder al input de html, y el .value, es para acceder al valor que se esta escribiendo en el 
    // console.log(e.target);
    datos [e.target.id] = e.target.value;
    console.log(datos);

}

usuario.addEventListener("change",resultado);
contrasena.addEventListener("change",resultado);
function envio (e){
    e.preventDefault();
    

    const {usuario,contrasena}= datos;
    if(usuario==="" || contrasena===""){
        e.preventDefault();
        mensaje("Para avanzar debes llenar todos los campos");
        return;
        
    }
        
    
    fetch("src/php/funciones/login/login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset=utf-8" 
        },
        body: JSON.stringify(datos)
    })
    .then(res => res.json())
    .then(data => {

        if (data.exito) {
            correcto();
        } else {
            mensaje(data.mensaje);
        }
    })
    .catch(err => {
        mensaje("Ocurrió un error al validar");
    });


}

