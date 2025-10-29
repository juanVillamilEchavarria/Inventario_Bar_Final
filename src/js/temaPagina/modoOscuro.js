const btnModo = document.querySelector("#btnModo");
const btnNewUser=document.querySelector("#btnUsuario");
const icono = btnModo.querySelector("i");
const body = document.querySelector("body");
const html = document.querySelector("html");
const logoListados = document.querySelector(".logo-listados");
const textoClaro=document.querySelectorAll(".texto-claro");
const formLabel=document.querySelectorAll(".form-label");
const modalTitle=document.querySelectorAll(".modal-title");
const formControl=document.querySelectorAll(".form-control");
const imagenProductoOscuro=document.querySelectorAll("#imagenProducto");
const imagenProductoModificarOscuro=document.querySelectorAll("#imagenProductoModificar");
const imagenProveedorOscuro=document.querySelectorAll("#imagenProveedor");
const imagenProveedorModificarOscuro=document.querySelectorAll("#imagenProveedorModificar");
const mensajeModalEliminar=document.querySelectorAll(".eliminar");


document.addEventListener("DOMContentLoaded", () => {
  const temaGuardado = localStorage.getItem("tema");
  if (temaGuardado === "dark") {
    modoOscuro();
  } else {
    modoClaro();
  }
});

btnModo.addEventListener("click", () => {
  if (body.getAttribute("data-bs-theme") === "light") {
    modoOscuro();
    localStorage.setItem("tema", "dark");
  } else {
    modoClaro();
    localStorage.setItem("tema", "light");
  }
});



function modoOscuro() {
  body.setAttribute("data-bs-theme", "dark");
  logoListados.classList.add("estilo-texto-oscuro");
  textoClaro.forEach(element => {
    element.classList.add("estilo-texto-oscuro");
  });
  btnNewUser.setAttribute("style", "color: #ffffff");
  icono.setAttribute("class", "fa-solid fa-sun fa-2xl");
  formLabel.forEach(element => {
    element.classList.add("estilo-texto-oscuro");
   
  })
  modalTitle.forEach(element => {
    element.classList.add("estilo-texto-oscuro");
  })
  formControl.forEach(element => {
    element.classList.add("estilo-input-oscuro");
  })
   imagenProductoOscuro.forEach(element => {
    element.classList.add("estilo-texto-oscuro");
  })
  imagenProductoModificarOscuro.forEach(element => {
    element.classList.add("estilo-texto-oscuro");
  })
  imagenProveedorOscuro.forEach(element => {
    element.classList.add("estilo-texto-oscuro");
  })
  imagenProveedorModificarOscuro.forEach(element => {
    element.classList.add("estilo-texto-oscuro");
  })
  mensajeModalEliminar.forEach(element => {
    element.classList.add("estilo-texto-oscuro");
  })
  html.setAttribute("data-bs-theme", "dark");

}

function modoClaro() {
  body.setAttribute("data-bs-theme", "light");
  logoListados.classList.remove("estilo-texto-oscuro");
  textoClaro.forEach(element => {
    element.classList.remove("estilo-texto-oscuro");
  });
  btnNewUser.setAttribute("style", "color: #000000");
  icono.setAttribute("class", "fa-solid fa-moon fa-2xl");
  formLabel.forEach(element => {
    element.classList.remove("estilo-texto-oscuro");
  })
  modalTitle.forEach(element => {
    element.classList.remove("estilo-texto-oscuro");
  })
  formControl.forEach(element => {
    element.classList.remove("estilo-input-oscuro");
  })
  imagenProductoOscuro.forEach(element => {
    element.classList.remove("estilo-texto-oscuro");
  })
  imagenProductoModificarOscuro.forEach(element => {
    element.classList.remove("estilo-texto-oscuro");
  })
  imagenProveedorOscuro.forEach(element => {
    element.classList.remove("estilo-texto-oscuro");
  })
  imagenProveedorModificarOscuro.forEach(element => {
    element.classList.remove("estilo-texto-oscuro");
  })
  mensajeModalEliminar.forEach(element => {
    element.classList.remove("estilo-texto-oscuro");
  })
  html.setAttribute("data-bs-theme", "light");
}
