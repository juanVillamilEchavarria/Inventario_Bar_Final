const botones = document.querySelectorAll(".nuevo, .modificar, .listar");
const agregarUsuario= document.querySelector(".contenedor-usuarioNuevo");



function sesion() {
    try {
        fetch("src/php/funciones/sesion/sesionActiva.php", {
        method: "GET",
        credentials: "include"
    })
    .then(res => res.json())
    .then(data => {

        if (data.exito && data.rol === "admin") {
           botones.forEach(boton => boton.style.display = "inline-block");
           agregarUsuario.classList.add("contenedor-usuarioNuevoV");
        }
        
    })
    .catch(error => {
        console.log("Error en fetch:", error);
    });
        
    } catch (error) {
        console.log(error);
        
    }
    
}
sesion();
