const mensajeExitoso = document.querySelector(".exitoso");
const mensajesErrores = document.querySelectorAll(".error");




window.addEventListener("load", () => {
    if (mensajeExitoso) {
        setTimeout(() => {
            mensajeExitoso.style.opacity = '0'; 
                    mensajeExitoso.addEventListener('transitionend', () => {
                        mensajeExitoso.remove();
                    });
        }, 3000);
    }
    mensajesErrores.forEach(mensajeError => {
         if (mensajeError) {
            setTimeout(() => {
                mensajeError.style.opacity = '0'; 
                        mensajeError.addEventListener('transitionend', () => {
                            mensajeError.remove();
                        });
            }, 3000);
    }
        
    })
   
});