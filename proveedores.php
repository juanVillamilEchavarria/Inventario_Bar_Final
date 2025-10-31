<?php
include_once 'includesPHP/listados_superior.php';
?>

<div class="container-fluid my-4">
        <div class="row">
            <div class="contenedor cl-12">
                <table id="datatable_proveedores" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-center">Logo de la Empresa</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center">Categoria de Licores</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody_proveedores">

                    </tbody>

                </table>
            </div>
        </div>
    </div>
      <!-- Modal Agregar -->
<div class="modal fade" data-bs-backdrop="static" id="modalAgregarProveedor" tabindex="-1" aria-labelledby="modalAgregarProveedorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarProveedorLabel"><span class="text-success">Agregar</span> Proveedor</h5>
       
      </div>
      <div class="modal-body">
        <form id="formAgregarProveedor">
          <div class="mb-3">
            <label for="nombreProveedor" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreProveedor" required>
          </div>
          <div class="mb-3">
            <label for="precioProveedor" class="form-label">Telefono</label>
            <input type="tel"  pattern="[0-9]{10}" class="form-control" id="telefonoProveedor" required>
          </div>
          <div class="mb-3">
            <label for="stockProveedor" class="form-label">Correo</label>
            <input type="text" class="form-control" id="correoProveedor" required>
          </div>
          <div class="mb-3 ">
            <label for="categoriaProveedor" class="form-label"> Categoria</label>
           <select class=" categoriaProveedor" id="categoriaProveedor">
                        <option disabled selected value="">Opciones</option>
                        <option value="Cerveza">Cerveza</option>
                        <option value="Whisky">Whisky</option>
                        <option value="Vino">Vino</option>
                        <option value="Ron">Ron</option>
                        <option value="Vodka">Vodka</option>
                        <option value="Tequila">Tequila</option>
                        <option value="Ginebra">Ginebra</option>
                        <option value="Brandy">Brandy</option>
                        <option value="Champagne">Champagne</option>
                        <option value="Otros">Otros</option>

                </select>
          </div>
          <div class="mb-3 contenedor-modal-imagen" >
            <label for="imagenProveedor" class="form-label"> Imagen</label>
            <input type="file" id="imagenProveedor" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-success" id="btnGuardarProveedor">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Modificar  -->
<div class="modal fade " data-bs-backdrop="static" id="modalModificarProveedor" tabindex="-1" aria-labelledby="modalModificarProveedorLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalModificarProveedorLabel"><span class="text-primary">Modificar</span> Proveedor</h5>
        
      </div>
      <div class="modal-body">
        <form id="formModificarProveedor">
          <input type="hidden" id="idProveedorModificar">
          <div class="mb-3">
            <label for="nombreProveedorModificar" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreProveedorModificar" required>
          </div>
          <div class="mb-3">
            <label for="precioProveedorModificar" class="form-label">Telefono</label>
            <input type="tel"  pattern="[0-9]{10}" class="form-control" id="telefonoProveedorModificar" required>
          </div>
          <div class="mb-3">
            <label for="stockProveedorModificar" class="form-label">Correo</label>
            <input type="text" class="form-control" id="correoProveedorModificar" required>
          </div>
          <div class="mb-3 ">
            <label for="categoriaProveedor" class="form-label"> Categoria</label>
           <select class=" categoriaProveedor" id="categoriaProveedorModificar">
                        <option disabled selected value="">Opciones</option>
                        <option value="Cerveza">Cerveza</option>
                        <option value="Whisky">Whisky</option>
                        <option value="Vino">Vino</option>
                        <option value="Ron">Ron</option>
                        <option value="Vodka">Vodka</option>
                        <option value="Tequila">Tequila</option>
                        <option value="Ginebra">Ginebra</option>
                        <option value="Brandy">Brandy</option>
                        <option value="Champagne">Champagne</option>
                        <option value="Otros">Otros</option>

                </select>
          </div>
          <div class="mb-3 contenedor-modal-imagen">
           <label for="imagenProveedor" class="form-label"> Imagen</label>
            <input type="file"  id="imagenProveedorModificar" required>
            <small id="infoImagenProveedorModificar" class="form-text text-muted"></small>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnActualizarProveedor">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade " data-bs-backdrop="static" id="modalEliminarProveedor" tabindex="-1" aria-labelledby="modalEliminarProveedorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarProveedorLabel"><span class="text-danger">Eliminar</span> Proveedor</h5>
       
      </div>
      <div class="modal-body">
        <p class="eliminar">¿Está seguro de eliminar este Proveedor?</p>
        <input type="hidden" id="idProveedorEliminar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnEliminarProveedor">Eliminar</button>
      </div>
    </div>
  </div>
</div>



<?php include_once 'includesPHP/scripts.php'; ?>
        <script src="dist/js/sesion/menuCerrar.js"></script>
<script src="dist/js/proveedores/dataTableProveedores.js"></script>
<script src="dist/js/proveedores/proveedores.js"></script>
<script src="dist/js/proveedores/crearProveedor.js"></script>
<script src="dist/js/proveedores/editarProveedor.js"></script>
<script src="dist/js/proveedores/eliminarProveedor.js"></script>
         <script src="dist/js/temaPagina/modoOscuro.js"></script>

    
</body>
</html>