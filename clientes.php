<?php include_once 'includesPHP/listados_superior.php';

?>
<div class="container-fluid my-4">
        <div class="row">
            <div class="contenedor cl-12">
                <table id="datatable_Clientes" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody_Clientes">

                    </tbody>

                </table>
            </div>
        </div>
    </div>
<!-- Modal Agregar -->
     <div class="modal fade" data-bs-backdrop="static" id="modalAgregarCliente" tabindex="-1" aria-labelledby="modalAgregarClienteLabel" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarClienteLabel"><span class="text-success">Agregar</span> Cliente</h5>
       
      </div>
      <div class="modal-body">
        <form id="formAgregarCliente">
          <div class="mb-3">
            <label for="nombreCliente" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreCliente" required>
          </div>
          <div class="mb-3">
            <label for="telefonoCliente" class="form-label">Telefono</label>
            <input type="tel"  pattern="[0-9]{10}" class="form-control" id="telefonoCliente" required>
          </div>
          <div class="mb-3">
            <label for="correoCliente" class="form-label">Correo</label>
            <input type="text" class="form-control" id="correoCliente" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-success" id="btnGuardarCliente">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Modificar  -->
<div class="modal fade " data-bs-backdrop="static" id="modalModificarCliente" tabindex="-1" aria-labelledby="modalModificarClienteLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalModificarClienteLabel"><span class="text-primary">Modificar</span> Cliente</h5>
        
      </div>
      <div class="modal-body">
        <form id="formModificarCliente">
          <input type="hidden" id="idClienteModificar">
          <div class="mb-3">
            <label for="nombreClienteModificar" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreClienteModificar" required>
          </div>
          <div class="mb-3">
            <label for="precioClienteModificar" class="form-label">Telefono</label>
            <input type="tel"  pattern="[0-9]{16}" class="form-control" id="telefonoClienteModificar" required>
          </div>
          <div class="mb-3">
            <label for="stockClienteModificar" class="form-label">Correo</label>
            <input type="text" class="form-control" id="correoClienteModificar" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnActualizarCliente">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade " data-bs-backdrop="static" id="modalEliminarCliente" tabindex="-1" aria-labelledby="modalEliminarClienteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarClienteLabel"><span class="text-danger">Eliminar</span> Cliente</h5>
       
      </div>
      <div class="modal-body">
        <p class="eliminar">¿Está seguro de eliminar este cliente?</p>
        <input type="hidden" id="idClienteEliminar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnEliminarCliente">Eliminar</button>
      </div>
    </div>
  </div>
</div>

    <?php include_once 'includesPHP/scripts.php'; ?>
     <script src="dist/js/clientes/dataTableClientes.js"></script>
 <script src="dist/js/clientes/clientes.js"></script>
 <script src="dist/js/clientes/crearCliente.js"></script>
 <script src="dist/js/clientes/editarCliente.js"></script>
 <script src="dist/js/clientes/eliminarCliente.js"></script>
          <script src="dist/js/temaPagina/modoOscuro.js"></script>
     
</body>
</html>
