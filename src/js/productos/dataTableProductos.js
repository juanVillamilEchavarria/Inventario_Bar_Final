// listado de productos
let datatable; // variable de la datatable
let datatableInicio = false; // empezamos con la variable en false (no existe la datatable)

const datatableParametros = {

    lengthMenu: [5, 10, 20, 100],
    columnDefs: [
        { className: "text-center align-middle", targets: [0,1,2,3,4,5] },
        { orderable: false, targets: [1,5] },
        { width: "20%", targets: [1] },
        { targets: [5], visible: false }
    ],
    destroy: true,
    language: {
        decimal: "",
        emptyTable: "No hay información",
        info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
        infoFiltered: "(Filtrado de _MAX_ total entradas)",
        infoPostFix: "",
        thousands: ",",
        lengthMenu: "Mostrar _MENU_ Entradas",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Buscar:",
        zeroRecords: "Sin resultados encontrados",
        paginate: {
            first: "Primero",
            last: "Ultimo",
            next: "Siguiente",
            previous: "Anterior"
        }
    },
    scrollX: false
}

function ajustarScroll() {
    let ancho = window.innerWidth;
    // forma compacta de un if, cuando ancho sea true, datatableparametros tambien
    datatableParametros.scrollX = (ancho <= 768);

    // Destruir y recrear la tabla con el nuevo parámetro
    if (datatableInicio) {
        datatable.destroy();
        datatable = $("#datatable_productos").DataTable(datatableParametros);
    }
}

const datatableRun = async () => {
    if (datatableInicio == true) {
        datatable.destroy();
    }
    await listaProductos();
    datatable = $("#datatable_productos").DataTable(datatableParametros);
    datatableInicio = true;
    ajustarScroll();
}

window.addEventListener("resize", () => {
    if (datatableInicio) {
        ajustarScroll();
    }
});

const listaProductos = async function() {
    try {
        const res= await fetch("src/php/funciones/productos/tablaProductos.php", {
            method: "GET",
           credentials: "include"
        })
        const data=await res.json();


        
    
            let contenido = "";
            data.forEach((user) => {
    
                contenido += `
                    <tr>
                        <td class="text-center tabla-campo">${user.id}</td>
                        <td class="text-center tabla-campo">
                           <img class ="imagen-tabla" src="/interGraficas/imagenes/productos/${user.imagen}" alt="${user.imagen}"
                                />
                        </td>
                        <td class="text-center tabla-campo">${user.nombre}</td>
                        <td class="text-center tabla-campo">$${user.precio}</td>
                        <td class="text-center tabla-campo">${user.stock}</td>
                        <td class="text-center tabla-campo">
                            <button  class="btn btn-primary btn-modificar " data-id="${user.id}"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-danger btn-eliminar" data-id="${user.id}"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>`;
            });

            const tableBody_productos = document.querySelector("#tableBody_productos");
            tableBody_productos.innerHTML = contenido;
        
    } catch (error) {
        alert(error);
    }
}

window.addEventListener("load", async () => {
    await datatableRun();
});




// botones
const modificar = document.querySelector(".modificar");
const listar = document.querySelector(".listar");

modificar.onclick = async () => {
    if (datatableInicio) {
        await datatable.column(5).visible(true);
    }
}

listar.addEventListener("click", async () => {
    if (datatableInicio) {
        datatable.column(5).visible(false);
    }
});







