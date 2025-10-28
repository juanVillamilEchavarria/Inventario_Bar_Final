const datosCrear={
    nombreProducto:"",
    precioProducto: 0,
    stockProducto: 0,
    imagenProducto: null
}
// inputs
const formAgregarProducto = document.querySelector("#formAgregarProducto");
const nombreProducto = document.querySelector("#nombreProducto");
const precioProducto = document.querySelector("#precioProducto");
const stockProducto = document.querySelector("#stockProducto");
const imagenProducto = document.querySelector("#imagenProducto");
// botones
const botonCrear = document.querySelector("#btnGuardarProducto");
const nuevo = document.querySelector(".nuevo");
// modales
const modalAgregarProducto = new bootstrap.Modal(document.querySelector('#modalAgregarProducto'));
nuevo.onclick = () => {
   abrirModalAgregarProducto();
}
// agregar nuevo
botonCrear.addEventListener("click",envioCrear);
// funciones
function limpiarFormularioAgregarProducto(){
    formAgregarProducto.reset();
            datosCrear.nombreProducto = "";
            datosCrear.precioProducto = "";
            datosCrear.stockProducto = "";
            datosCrear.imagenProducto = null;
}

function mensaje (aviso,advertencia="", icono=`<svg  xmlns="http://www.w3.org/2000/svg"  width="74"  height="74"  viewBox="0 0 24 24"  fill="none"  stroke="#b61111"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>`){
   document.querySelector(".divError")?.remove();
    // crear mensaje 1
    const mensaje = document.createElement("P");
    mensaje.textContent= aviso;
    mensaje.classList.add("avisoFormulario");

    // crear mensaje 2
    const mensajeError = document.createElement("P");
    mensajeError.textContent= advertencia;
    mensajeError.classList.add("errorFormulario");

    // crear icono
    const mensajeIcono = document.createElement("SVG");
    mensajeIcono.innerHTML= icono;
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
    const backBody = document.querySelector("#modalAgregarProducto");
    backBody.classList.add("backError");
    backBody.appendChild(divError);
    mensajeBoton.onclick=cerrarMensaje;




}
function cerrarMensaje(){
    const divMensaje = document.querySelector(".divMensaje");
    const divError = document.querySelector(".divError");
    divMensaje?.remove();
    divError?.remove();
    
}
function abrirModalAgregarProducto(){
    limpiarFormularioAgregarProducto();
    modalAgregarProducto.show();
}
function cerrarModalAgregarProducto(){
    modalAgregarProducto.hide();
}

function envioCrear(e) {
    e.preventDefault();
    if (datosCrear.nombreProducto === "" || datosCrear.precioProducto <= 0 || datosCrear.stockProducto <= 0 || datosCrear.imagenProducto === null) {
        mensaje("Para avanzar debes llenar todos los campos");
        return;
    }

    const formData = new FormData();
    formData.append("nombreProducto", datosCrear.nombreProducto);
    formData.append("precioProducto", datosCrear.precioProducto);
    formData.append("stockProducto", datosCrear.stockProducto);
    formData.append("imagenProducto", datosCrear.imagenProducto);

    fetch("src/php/funciones/crearProducto.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data.exito) {
            mensaje("Producto creado con éxito","",'<svg  xmlns="http://www.w3.org/2000/svg"  width="74"  height="74"  viewBox="0 0 24 24"  fill="#00c20d"  class="icon icon-tabler icons-tabler-filled icon-tabler-rosette-discount-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>');
            limpiarFormularioAgregarProducto();
            setTimeout(() => {
                cerrarModalAgregarProducto();
                
            }, 2000);
        } else {
            mensaje(data.mensaje,"ADVERTENCIA");
        }
    })
    .catch(error => console.error("Error en fetch:", error));
}


function resultadoCrear(e) {
    if (e.target.type === "file") {
        datosCrear[e.target.id] = e.target.files[0];
    } else if (e.target.type === "number") {
        datosCrear[e.target.id] = parseFloat(e.target.value);
    } else {
        datosCrear[e.target.id] = e.target.value;
    }
    console.log(datosCrear);
}

nombreProducto.addEventListener("change",resultadoCrear);
precioProducto.addEventListener("change",resultadoCrear);
stockProducto.addEventListener("change",resultadoCrear);
imagenProducto.addEventListener("change",resultadoCrear);