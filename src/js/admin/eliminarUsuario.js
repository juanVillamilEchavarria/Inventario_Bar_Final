const eliminarUser= document.querySelectorAll(".eliminar-user");
const modalEliminarUsuario= new bootstrap.Modal(document.querySelector("#modalEliminarUsuario"));


function abrirModalEliminarUser(){
    modalEliminarUsuario.show();
}

function cerrarModalEliminarUser(){
    modalEliminarUsuario.hide();
}

eliminarUser.forEach(element => {
    element.addEventListener("click", abrirModalEliminarUser);
});