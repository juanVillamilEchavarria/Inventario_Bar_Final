const datosEditarProveedor={
    idProveedorModificar:0,
    nombreProveedorModificar:"",
    telefonoProveedorModificar:"",
    correoProveedorModificar:"",
    categoriaProveedorModificar:"",
    imagenProveedorModificar:""
} 
// inputs
const formModificarProveedor=document.querySelector("#formModificarProveedor");
const idProveedorModificar = document.querySelector("#idProveedorModificar");
const nombreProveedorModificar = document.querySelector("#nombreProveedorModificar");
const telefonoProveedorModificar = document.querySelector("#telefonoProveedorModificar");
const correoProveedorModificar = document.querySelector("#correoProveedorModificar");
const categoriaProveedorModificar = document.querySelector("#categoriaProveedorModificar");
const imagenProveedorModificar = document.querySelector("#imagenProveedorModificar");
const infoImagenProveedorModificar = document.querySelector("#infoImagenProveedorModificar");
// botones
const btnActualizarProveedor = document.querySelector("#btnActualizarProveedor");
// modales
const modalModificarProveedor = new bootstrap.Modal(document.querySelector('#modalModificarProveedor'));
// datatable body
const bodyDatatableProveedores = document.querySelector("#tableBody_proveedores");

bodyDatatableProveedores.addEventListener("click", abrirModalModificarProveedor);
btnActualizarProveedor.addEventListener("click", envioEditarProveedor);
// funciones
function resetearFormulario(){
    formModificarProveedor.reset();
    datosEditarProveedor.nombreProveedorModificar = "";
    datosEditarProveedor.telefonoProveedorModificar = "";
    datosEditarProveedor.correoProveedorModificar = "";
    datosEditarProveedor.categoriaProveedorModificar = "";
}
function rellenarCampos(){
    console.log("Enviando al PHP:", {idProveedorModificar: datosEditarProveedor.idProveedorModificar});
    try {
        fetch ("src/php/funciones/proveedores/preEditarProveedor.php",{
            method: "POST",
            headers: {
                "Content-Type": "application/json; charset=utf-8"
            },
            body: JSON.stringify({
                idProveedorModificar: datosEditarProveedor.idProveedorModificar
            })
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            if (data.exito) {
                datosEditarProveedor.correoProveedorModificar = data.proveedor.correo;
                datosEditarProveedor.telefonoProveedorModificar = data.proveedor.telefono;
                datosEditarProveedor.nombreProveedorModificar = data.proveedor.nombre;
                datosEditarProveedor.categoriaProveedorModificar = data.proveedor.categoria;
                correoProveedorModificar.value = data.proveedor.correo;
                telefonoProveedorModificar.value = data.proveedor.telefono;
                nombreProveedorModificar.value = data.proveedor.nombre;
                categoriaProveedorModificar.value = data.proveedor.categoria;
                infoImagenProveedorModificar.textContent = "Ya hay una foto cargada";
            } else {
                mensajeEditarProveedor(data.mensaje);
            }
            
        })
        .catch(error => console.error("Error en fetch:", error));
        
    } catch (error) {
        console.log(error);
        
    }
}
function abrirModalModificarProveedor(e){
    const btnModificar = e.target.closest(".btn-modificar");

    if (btnModificar) {
        resetearFormulario();
        datosEditarProveedor.idProveedorModificar = btnModificar.dataset.id; 
        idProveedorModificar.value = btnModificar.dataset.id;
        modalModificarProveedor.show();

        rellenarCampos();
    }
}
function cerrarModalModificarProveedor(){
    modalModificarProveedor.hide();

}
function mensajeEditarProveedor (aviso,advertencia="", icono=`<svg  xmlns="http://www.w3.org/2000/svg"  width="74"  height="74"  viewBox="0 0 24 24"  fill="none"  stroke="#b61111"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>`){

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
    const backBody = document.querySelector("#modalModificarProveedor");
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


function envioEditarProveedor(e){
    e.preventDefault();
    const {idProveedorModificar,nombreProveedorModificar,telefonoProveedorModificar,correoProveedorModificar,categoriaProveedorModificar,imagenProveedorModificar}= datosEditarProveedor;
    if (idProveedorModificar === "" || nombreProveedorModificar === "" || telefonoProveedorModificar === "" || correoProveedorModificar === "" || categoriaProveedorModificar === "") {
        mensajeEditarProveedor("Todos los campos son obligatorios");
        return;
    }
    if (!/^\+?[0-9 ]+$/.test(telefonoProveedorModificar)) {
    mensajeEditarProveedor("El teléfono debe contener solo números y opcionalmente iniciar con +","ADVERTENCIA");
    return;
}
    try {
        const formData = new FormData(formModificarProveedor);
        formData.append("idProveedorModificar", idProveedorModificar);
        formData.append("nombreProveedorModificar", nombreProveedorModificar);
        formData.append("telefonoProveedorModificar", telefonoProveedorModificar);
        formData.append("correoProveedorModificar", correoProveedorModificar);
        formData.append("categoriaProveedorModificar", categoriaProveedorModificar);
        formData.append("imagenProveedorModificar", imagenProveedorModificar);
        fetch("src/php/funciones/proveedores/editarProveedor.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            if (data.exito) {
                mensajeEditarProveedor(data.mensaje,"",'<svg  xmlns="http://www.w3.org/2000/svg"  width="74"  height="74"  viewBox="0 0 24 24"  fill="#00c20d"  class="icon icon-tabler icons-tabler-filled icon-tabler-rosette-discount-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>');            
                resetearFormulario();
                setTimeout(() => {
                    cerrarModalModificarProveedor();


                    
                }, 2000);
            } else {
                mensajeEditarProveedor(data.mensaje,"ADVERTENCIA");
            }
        })
        .catch(error => console.error("Error en fetch:", error));
        
    } catch (error) {
        console.log(error);
        
    }

}

function resultadoEditarProveedor(e){
    if (e.target.type === "file") {
        datosEditarProveedor[e.target.id] = e.target.files[0];
    } else if (e.target.type === "number") {
        datosEditarProveedor[e.target.id] = parseFloat(e.target.value);
    } else {
        datosEditarProveedor[e.target.id] = e.target.value;
    }
    console.log(datosEditarProveedor);
}
nombreProveedorModificar.addEventListener("change", resultadoEditarProveedor);
telefonoProveedorModificar.addEventListener("change", resultadoEditarProveedor);
correoProveedorModificar.addEventListener("change", resultadoEditarProveedor);
categoriaProveedorModificar.addEventListener("change", resultadoEditarProveedor);
imagenProveedorModificar.addEventListener("change", resultadoEditarProveedor);