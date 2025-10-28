const datosCrearProveedor={
    nombreProveedor: "",
    telefonoProveedor: "",
    correoProveedor: "",
    categoriaProveedor: "",
    imagenProveedor: null
}
// inputs
const formAgregarProveedor = document.querySelector("#formAgregarProveedor");
const nombreProveedor = document.querySelector("#nombreProveedor");
const telefonoProveedor = document.querySelector("#telefonoProveedor");
const correoProveedor = document.querySelector("#correoProveedor");
const categoriaProveedor = document.querySelector("#categoriaProveedor");
const imagenProveedor = document.querySelector("#imagenProveedor");
// botones
const botonCrear = document.querySelector("#btnGuardarProveedor");
const btnNuevo = document.querySelector(".nuevo");
// modales
const modalAgregarProveedor = new bootstrap.Modal(document.querySelector('#modalAgregarProveedor'));


botonCrear.addEventListener("click", envioCrearProveedor);
btnNuevo.onclick = () => {
    abrirModalAgregarProveedor();
}
// funciones
function limpiarFormularioAgregarProveedor() {
    formAgregarProveedor.reset();
    datosCrearProveedor.nombreProveedor = "";
    datosCrearProveedor.telefonoProveedor = "";
    datosCrearProveedor.correoProveedor = "";
    datosCrearProveedor.categoriaProveedor = "";
    datosCrearProveedor.imagenProveedor = null;
}
function abrirModalAgregarProveedor() {
    limpiarFormularioAgregarProveedor();
    modalAgregarProveedor.show();
}
function cerrarModalAgregarProveedor() {
    modalAgregarProveedor.hide();
}

function mensajeAgregarProveedor (aviso,advertencia="", icono=`<svg  xmlns="http://www.w3.org/2000/svg"  width="74"  height="74"  viewBox="0 0 24 24"  fill="none"  stroke="#b61111"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>`){
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
    const backBody = document.querySelector("#modalAgregarProveedor");
    backBody.classList.add("backError");
    backBody.appendChild(divError);
    mensajeBoton.onclick=cerrarMensajeAgregarProveedor;




}
function cerrarMensajeAgregarProveedor(){
    const divMensaje = document.querySelector(".divMensaje");
    const divError = document.querySelector(".divError");
    divMensaje?.remove();
    divError?.remove();
    
}

function envioCrearProveedor(e) {
    e.preventDefault();
    const {nombreProveedor,telefonoProveedor,correoProveedor,categoriaProveedor,imagenProveedor}= datosCrearProveedor;
    if (nombreProveedor === "" || telefonoProveedor === "" || correoProveedor === "" || categoriaProveedor === "" || imagenProveedor === null) {
        mensajeAgregarProveedor("Todos los campos son obligatorios","ADVERTENCIA");
        return;
    }
    if (!/^\+?[0-9 ]+$/.test(telefonoProveedor)) {
    mensajeAgregarProveedor("El teléfono debe contener solo números y opcionalmente iniciar con +","ADVERTENCIA");
    return;
}
    const formData = new FormData(formAgregarProveedor);
    formData.append("nombreProveedor", nombreProveedor);
    formData.append("telefonoProveedor", telefonoProveedor);
    formData.append("correoProveedor", correoProveedor);
    formData.append("categoriaProveedor", categoriaProveedor);
    formData.append("imagenProveedor", imagenProveedor);
    fetch("src/php/funciones/proveedores/crearProveedor.php", {
        method: "POST",
       
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.exito) {    
                mensajeAgregarProveedor(data.mensaje,"",'<svg  xmlns="http://www.w3.org/2000/svg"  width="74"  height="74"  viewBox="0 0 24 24"  fill="#00c20d"  class="icon icon-tabler icons-tabler-filled icon-tabler-rosette-discount-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>'); 
                limpiarFormularioAgregarProveedor();
                setTimeout(() => {
                     cerrarModalAgregarProveedor();
                    
                }, 2000);           
               
            
            } else {
                mensajeAgregarProveedor(data.message);
            }
        })
        .catch((error) => console.error(error));
}
function resultadoAgregarProveedor(e) {
    if (e.target.type === "file") {
        datosCrearProveedor[e.target.id] = e.target.files[0];
    } else if (e.target.type === "number") {
        datosCrearProveedor[e.target.id] = parseFloat(e.target.value);
    } else {
        datosCrearProveedor[e.target.id] = e.target.value;
    }
    console.log(datosCrearProveedor);
    
}
nombreProveedor.addEventListener("change", resultadoAgregarProveedor);
telefonoProveedor.addEventListener("change", resultadoAgregarProveedor);
correoProveedor.addEventListener("change", resultadoAgregarProveedor);
categoriaProveedor.addEventListener("change", resultadoAgregarProveedor);
imagenProveedor.addEventListener("change", resultadoAgregarProveedor);