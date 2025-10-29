<?php include_once 'includesPHP/listados_superior.php'; 



?>

    <div class="container-fluid my-4">
        <div class="row">
            <div class="contenedor cl-12">
                <table id="datatable_productos" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-center">Imagen de Referencia</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody_productos">

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- Modal Agregar -->
<div class="modal fade" data-bs-backdrop="static" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalAgregarProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarProductoLabel"><span class="text-success">Agregar</span> Producto</h5>
       
      </div>
      <div class="modal-body">
        <form id="formAgregarProducto">
          <div class="mb-3">
            <label for="nombreProducto" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreProducto" required>
          </div>
          <div class="mb-3">
            <label for="precioProducto"  class="form-label">Precio</label>
            <input type="number" min="0.01" step="0.01" class="form-control" id="precioProducto" required>
          </div>
          <div class="mb-3">
            <label for="stockProducto" class="form-label">Stock</label>
            <input type="number" min="1" step="1" class="form-control" id="stockProducto" required>
          </div>
          <div class="mb-3 contenedor-modal-imagen" >
            <label for="imagenProducto" class="form-label"> Imagen</label>
            <input type="file" id="imagenProducto" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-success" id="btnGuardarProducto">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Modificar  -->
<div class="modal fade " data-bs-backdrop="static" id="modalModificarProducto" tabindex="-1" aria-labelledby="modalModificarProductoLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalModificarProductoLabel"><span class="text-primary">Editar</span> Producto</h5>
        
      </div>
      <div class="modal-body">
        <form id="formModificarProducto">
          <input type="hidden" id="idProductoModificar">
          <div class="mb-3">
            <label for="nombreProductoModificar" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreProductoModificar" required>
          </div>
          <div class="mb-3">
            <label for="precioProductoModificar" class="form-label">Precio</label>
            <input type="number" min="0.01" step="0.01" class="form-control" id="precioProductoModificar" required>
          </div>
          <div class="mb-3">
            <label for="stockProductoModificar" class="form-label">Stock</label>
            <input type="number" min="1" step="1" class="form-control" id="stockProductoModificar" required>
          </div>
          <div class="mb-3 contenedor-modal-imagen">
           <label for="imagenProducto" class="form-label"> Imagen</label>
            <input type="file"  id="imagenProductoModificar" required>
            <small id="infoImagenProductoModificar" class="form-text text-muted"></small>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnActualizarProducto">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade " data-bs-backdrop="static" id="modalEliminarProducto" tabindex="-1" aria-labelledby="modalEliminarProductoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarProductoLabel"><span class="text-danger">Eliminar</span> Producto</h5>
       
      </div>
      <div class="modal-body">
        <p class="eliminar">¿Está seguro de eliminar este producto?</p>
        <input type="hidden" id="idProductoEliminar">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnEliminarProducto">Eliminar</button>
      </div>
    </div>
  </div>
</div>


   <?php include_once 'includesPHP/scripts.php'; ?>
        <script src="dist/js/productos/dataTableProductos.js"></script>
    
        <script src="dist/js/productos/productos.js"></script>
        <script src="dist/js/productos/crearProducto.js"></script>
        <script src="dist/js/productos/editarProducto.js"></script>
        <script src="dist/js/productos/eliminarProducto.js"></script>
                 <script src="dist/js/temaPagina/modoOscuro.js"></script>

    
</body>
</html>