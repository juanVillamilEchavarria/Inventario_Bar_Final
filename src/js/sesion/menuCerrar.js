const menuCerrar=document.querySelector(".menu-cerrar");
const contenidoMenu=document.querySelector(".contenido-menu");
const contenedorInfoUsuario=document.querySelector(".contenedor-info-usuario");
const contenedorUsuario=document.querySelector(".contenedor-usuario");
const contenedorUsuarioNuevoV=document.querySelector(".contenedor-usuarioNuevo");

function crearMenu(){
    contenedorInfoUsuario.classList.remove("no-display");
    contenedorUsuarioNuevoV.classList.remove("no-display");
    const divMenuModal= document.createElement("DIV");
    divMenuModal.classList.add("modal-menu-cerrar");

    contenedorUsuario.appendChild(divMenuModal);
    divMenuModal.appendChild(menuCerrar);
    menuCerrar.appendChild(contenidoMenu);

    divMenuModal.offsetHeight;

    divMenuModal.classList.add("menu-activo")

}


function cerrarMenu(){
    const divMenuModal= document.querySelector(".modal-menu-cerrar");
    if(divMenuModal){

        divMenuModal.classList.remove("menu-activo", "modal-menu-cerrar");
        divMenuModal.remove();
        contenedorUsuario.appendChild(menuCerrar);
        
        contenedorInfoUsuario.classList.add("no-display");
        contenedorUsuarioNuevoV.classList.add("no-display");
    }
}

function addEventListenerCerrarMenu(){
    menuCerrar.addEventListener("click", () => {
        const divMenuModal= document.querySelector(".modal-menu-cerrar");
        if(divMenuModal){
           cerrarMenu();
        }else{
            crearMenu();
        }
    });
}


document.addEventListener("DOMContentLoaded", () => {
    addEventListenerCerrarMenu();
});