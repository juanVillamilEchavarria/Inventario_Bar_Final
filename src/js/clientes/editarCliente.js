const datosEditarCliente={
    idClienteModificar: 0,
    nombreClienteModificar:"",
    telefonoClienteModificar: "",
    correoClienteModificar: "",
}
// inputs
const formModificarCliente = document.querySelector("#formModificarCliente");
const idClienteModificar = document.querySelector("#idClienteModificar");
const nombreClienteModificar = document.querySelector("#nombreClienteModificar");
const telefonoClienteModificar = document.querySelector("#telefonoClienteModificar");
const correoClienteModificar = document.querySelector("#correoClienteModificar");
// modales
const modalModificarCliente = new bootstrap.Modal(document.querySelector('#modalModificarCliente'));
// botones
const btnActualizarCliente = document.querySelector("#btnActualizarCliente");
// cada que haga click, llama a abrirModal
bodyDatatable.addEventListener("click", abrirModalModificarCliente);
btnActualizarCliente.addEventListener("click", envioEditarCliente);
// funciones
function resetearFormulario() {
    formModificarCliente.reset();
    datosEditarCliente.correoClienteModificar = "";
    datosEditarCliente.telefonoClienteModificar = "";
    datosEditarCliente.nombreClienteModificar = "";
}


function rellenarCampos() {
    console.log("Enviando al PHP:", {idClienteModificar: datosEditarCliente.idClienteModificar});
    try {

        const formData= new FormData();
        formData.append("idClienteModificar",datosEditarCliente.idClienteModificar);
        fetch("src/php/funciones/clientes/preEditarCliente.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            if (data.exito) {
                datosEditarCliente.correoClienteModificar = data.cliente.correo;
                datosEditarCliente.telefonoClienteModificar = data.cliente.telefono;
                datosEditarCliente.nombreClienteModificar = data.cliente.nombre;
                correoClienteModificar.value = data.cliente.correo;
                telefonoClienteModificar.value = data.cliente.telefono;
                nombreClienteModificar.value = data.cliente.nombre;
            } else {
                mensajeEditarCliente(data.mensaje);
            }
        })
        .catch(error => console.error("Error en fetch:", error));
        
    } catch (error) {
        
    }
}
function abrirModalModificarCliente(e) {
    try {
         const btnModificar = e.target.closest(".btn-modificar");
    if (btnModificar) {
         resetearFormulario();
        datosEditarCliente.idClienteModificar = btnModificar.dataset.id;
        idClienteModificar.value = btnModificar.dataset.id;
        console.log(datosEditarCliente.idClienteModificar);
        modalModificarCliente.show();
        rellenarCampos();
    }
        
    } catch (error) {
        console.log(error);
        
    }
   
}

function cerrarModalModificarCliente() {
    modalModificarCliente.hide();
}   

function mensajeEditarCliente (aviso,advertencia="", icono=`<svg  xmlns="http://www.w3.org/2000/svg"  width="74"  height="74"  viewBox="0 0 24 24"  fill="none"  stroke="#b61111"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>`){

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
    const backBody = document.querySelector("#modalModificarCliente");
    backBody.classList.add("backError");
    backBody.appendChild(divError);
    mensajeBoton.onclick=cerrarMensajeEditar;

}
function cerrarMensajeEditar(){
    const divMensaje = document.querySelector(".divMensaje");
    const divError = document.querySelector(".divError");
    divMensaje?.remove();
    divError?.remove();
    
}
function envioEditarCliente(e){
    e.preventDefault();
    const {nombreClienteModificar,telefonoClienteModificar,correoClienteModificar}=datosEditarCliente;
    if(nombreClienteModificar==""||telefonoClienteModificar==""||correoClienteModificar==""){
        mensajeEditarCliente("Los campos no pueden estar vacios","ADVERTENCIA");
        return;
    }

if (!/^\+?[0-9 ]+$/.test(telefonoClienteModificar)) {
    mensajeEditarCliente("El teléfono debe contener solo números y opcionalmente iniciar con +","ADVERTENCIA");
    return;
}
const formData= new FormData();
    formData.append("idClienteModificar",datosEditarCliente.idClienteModificar);
    formData.append("nombreClienteModificar",datosEditarCliente.nombreClienteModificar);
    formData.append("telefonoClienteModificar",datosEditarCliente.telefonoClienteModificar);
    formData.append("correoClienteModificar",datosEditarCliente.correoClienteModificar);


    fetch ("src/php/funciones/clientes/editarCliente.php",{
        method:"POST",
        body: formData
    })
    .then(res=>res.json())
    .then(data=>{
        console.log(data);
        if(data.exito){
            mensajeEditarCliente(data.mensaje,"",'<svg  xmlns="http://www.w3.org/2000/svg"  width="74"  height="74"  viewBox="0 0 24 24"  fill="#00c20d"  class="icon icon-tabler icons-tabler-filled icon-tabler-rosette-discount-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>');
            setTimeout(() => {
                            cerrarModalModificarCliente();
                
            }, 2000);

            
        }else{
            mensajeEditarCliente(data.mensaje,"ADVERTENCIA");
        }
    })
    .catch(error => console.error("Error en fetch:", error));

    
}
function resultadoEditarCliente(e){
    if (e.target.type==="number"){
        datosEditarCliente[e.target.id]=parseFloat(e.target.value);
    }else{
        datosEditarCliente[e.target.id]=e.target.value;
    }
    console.log(datosEditarCliente);
}
nombreClienteModificar.addEventListener("change", resultadoEditarCliente);
telefonoClienteModificar.addEventListener("change", resultadoEditarCliente);
correoClienteModificar.addEventListener("change", resultadoEditarCliente);
