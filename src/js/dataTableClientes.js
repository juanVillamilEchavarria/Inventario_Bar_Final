// listado de productos
let datatable; // variable de la datatable
let datatableInicio = false; // empezamos con la variable en false (no existe la datatable)

const datatableParametros = {

    lengthMenu: [5, 10, 20, 100],
    columnDefs: [
        { className: "text-center align-middle", targets: [0,1,2,3,4] },
        { orderable: false, targets: [4] },
        { width: "20%", targets: [1] },
        { targets: [4], visible: false }
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
        datatable = $("#datatable_Clientes").DataTable(datatableParametros);
    }
}

const datatableRun = async () => {
    if (datatableInicio == true) {
        datatable.destroy();
    }
    await listaClientes();
    datatable = $("#datatable_Clientes").DataTable(datatableParametros);
    datatableInicio = true;
    ajustarScroll();
}

window.addEventListener("resize", () => {
    if (datatableInicio) {
        ajustarScroll();
    }
});

const listaClientes = async function() {
    try {
        const res= await fetch("src/php/funciones/tablaClientes.php", {
            method: "GET",
           credentials: "include"
        })
        const data=await res.json();
        
    
            let contenido = "";
            data.forEach((user) => {
    
                contenido += `
                    <tr>
                        <td class="text-center tabla-campo">${user.id}</td>
                        <td class="text-center tabla-campo">${user.nombre}</td>
                        <td class="text-center tabla-campo">${user.telefono}</td>
                        <td class="text-center tabla-campo">${user.correo}</td>
                        <td class="text-center tabla-campo">
                            <button  class="btn btn-primary btn-modificar" data-id=${user.id}><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-danger btn-eliminar" data-id=${user.id}><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>`;
            });

            const tableBody_productos = document.querySelector("#tableBody_Clientes");
            tableBody_productos.innerHTML = contenido;
        
    } catch (error) {
        alert(error);
    }
}

window.addEventListener("load", async () => {
    await datatableRun();
});

// funcionalidades CRUD
// modales



// datatable body
const bodyDatatable = document.querySelector("#tableBody_Clientes");   

// botones

const modificar = document.querySelector(".modificar");
const listar = document.querySelector(".listar");

modificar.onclick = async () => {
    if (datatableInicio) {
        await datatable.column(4).visible(true);
    }
}

listar.addEventListener("click", async () => {
    if (datatableInicio) {
        datatable.column(4).visible(false);
    }
});
    


