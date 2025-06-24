
<div class="admin-container">
    <div class="admin-header">
        <h1>Panel de Administración - Productos</h1>
        <button class="btn btn-primary" onclick="openCreateModal()">Agregar Nuevo Producto</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="products-table">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                    <th>Precio Original</th>
                    <th>Precio Oferta</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Destacado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>
                            <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('imagenes/default-product.png') }}" 
                                    alt="{{ $producto->nombre }}" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>{{ $producto->categoria_display }}</td>
                        <td>S/ {{ number_format($producto->precio_original, 2) }}</td>
                        <td>S/ {{ number_format($producto->precio_oferta, 2) }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>
                            <span class="badge {{ $producto->activo ? 'badge-success' : 'badge-danger' }}">
                                {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $producto->destacado ? 'badge-primary' : 'badge-secondary' }}">
                                {{ $producto->destacado ? 'Destacado' : 'Normal' }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="editProduct({{ $producto->id }})">
                                Editar
                            </button>
                            <form method="POST" action="{{ route('productos.toggle', $producto) }}" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $producto->activo ? 'btn-warning' : 'btn-success' }}">
                                    {{ $producto->activo ? 'Desactivar' : 'Activar' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('productos.destroy', $producto) }}" style="display: inline;" 
                                  onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">No hay productos registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="pagination-wrapper">
        {{ $productos->links() }}
    </div>
</div>

<!-- Modal para Crear/Editar Producto -->
<div id="productModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Agregar Nuevo Producto</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <form id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="methodField"></div>
            
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="3"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="precio_original">Precio Original:</label>
                    <input type="number" id="precio_original" name="precio_original" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="precio_oferta">Precio Oferta:</label>
                    <input type="number" id="precio_oferta" name="precio_oferta" step="0.01" min="0" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" min="0" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $key => $nombre)
                            <option value="{{ $key }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
                <div id="imagePreview"></div>
            </div>

            <div class="form-checkboxes">
                <div class="checkbox-group">
                    <input type="checkbox" id="activo" name="activo" checked>
                    <label for="activo">Producto Activo</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="destacado" name="destacado">
                    <label for="destacado">Producto Destacado</label>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Agregar Nuevo Producto';
    document.getElementById('productForm').action = '{{ route("productos.store") }}';
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('productForm').reset();
    document.getElementById('imagePreview').innerHTML = '';
    document.getElementById('productModal').style.display = 'block';
}

function editProduct(id) {
    fetch(`/admin/productos/${id}/edit`)
        .then(response => response.json())
        .then(producto => {
            document.getElementById('modalTitle').textContent = 'Editar Producto';
            document.getElementById('productForm').action = `/admin/productos/${id}`;
            document.getElementById('methodField').innerHTML = '@method("PUT")';
            
            // Llenar el formulario con los datos del producto
            document.getElementById('nombre').value = producto.nombre;
            document.getElementById('marca').value = producto.marca;
            document.getElementById('descripcion').value = producto.descripcion || '';
            document.getElementById('precio_original').value = producto.precio_original;
            document.getElementById('precio_oferta').value = producto.precio_oferta;
            document.getElementById('stock').value = producto.stock;
            document.getElementById('categoria').value = producto.categoria;
            document.getElementById('activo').checked = producto.activo;
            document.getElementById('destacado').checked = producto.destacado;
            
            // Mostrar imagen actual si existe
            if (producto.imagen) {
                document.getElementById('imagePreview').innerHTML = 
                    `<img src="/storage/${producto.imagen}" alt="Imagen actual" style="max-width: 200px; max-height: 200px; margin-top: 10px;">`;
            }
            
            document.getElementById('productModal').style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar los datos del producto');
        });
}

function closeModal() {
    document.getElementById('productModal').style.display = 'none';
}

// Cerrar modal al hacer click fuera de él
window.onclick = function(event) {
    const modal = document.getElementById('productModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Preview de imagen
document.getElementById('imagen').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 200px; max-height: 200px; margin-top: 10px;">`;
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '';
    }
});
</script>

<style>
.admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.table th, .table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table th {
    background-color: #f8f9fa;
    font-weight: bold;
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin: 2px;
}

.btn-primary { background-color: #007bff; color: white; }
.btn-info { background-color: #17a2b8; color: white; }
.btn-success { background-color: #28a745; color: white; }
.btn-warning { background-color: #ffc107; color: black; }
.btn-danger { background-color: #dc3545; color: white; }
.btn-secondary { background-color: #6c757d; color: white; }

.btn-sm {
    padding: 4px 8px;
    font-size: 12px;
}

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.badge-success { background-color: #28a745; color: white; }
.badge-danger { background-color: #dc3545; color: white; }
.badge-primary { background-color: #007bff; color: white; }
.badge-secondary { background-color: #6c757d; color: white; }

.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 0;
    border-radius: 8px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
    padding: 20px;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.close {
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: #000;
}

.modal-content form {
    padding: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-row {
    display: flex;
    gap: 15px;
}

.form-row .form-group {
    flex: 1;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input, .form-group select, .form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-checkboxes {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.checkbox-group {
    display: flex;
    align-items: center;
    gap: 5px;
}

.checkbox-group input[type="checkbox"] {
    width: auto;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert ul {
    margin: 0;
    padding: 0;
    list-style: none;
}