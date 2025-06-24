@include('components.navtecsupfit')
@section('title', 'Libro de Reclamaciones')

<div class="container py-5" style="display:flex; flex-direction:column;padding-top:7rem; align-items:center; background-color:white; min-height:900px;">
    <h2 class="mb-4 text-center">Libro de Reclamaciones</h2>

    <form method="POST" action="{{ route('index') }}" id="reclamacionForm">
        @csrf

        <div class="row mb-3" style="display:flex;">
        <div class="contenedor-de-reclamos-1">
            <div class="col-md-4">
                <label for="tipo_documento" class="form-label">Tipo de documento</label>
                <select class="form-select" name="tipo_documento" required>
                    <option value="">Selecciona</option>
                    <option value="dni">DNI</option>
                    <option value="ce">C.E.</option>
                    <option value="pasaporte">Pasaporte</option>
                    <option value="ruc">RUC</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="numero_documento" class="form-label">Número de documento</label>
                <input type="text" class="form-control" name="numero_documento" required>
            </div>
            <div class="col-md-4">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" required>
            </div>


        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombres" required>
            </div>
            <div class="col-md-6">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <textarea class="form-control" name="direccion" rows="2" required></textarea>
        </div>
    </div>

    <div class="contenedor-de-reclamos-2">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="numero_pedido" class="form-label">Número de pedido (opcional)</label>
                <input type="text" class="form-control" name="numero_pedido">
            </div>
            <div class="col-md-6">
                <label for="fecha_compra" class="form-label">Fecha de compra (opcional)</label>
                <input type="date" class="form-control" name="fecha_compra">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="tipo_reclamo" class="form-label">Tipo</label>
                <select class="form-select" name="tipo_reclamo" required>
                    <option value="">Selecciona</option>
                    <option value="reclamo">Reclamo</option>
                    <option value="queja">Queja</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="producto" class="form-label">Producto(s)</label>
                <input type="text" class="form-control" name="producto" required>
                {{-- Si ya tienes orden_id puedes autollenar esto por JS --}}
            </div>
        </div>

        <div class="mb-3">
            <label for="detalle_reclamo" class="form-label">Detalle del reclamo</label>
            <textarea class="form-control" name="detalle_reclamo" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="pedido_cliente" class="form-label">¿Qué solución solicita?</label>
            <textarea class="form-control" name="pedido_cliente" rows="2" required></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">Enviar reclamo</button>
        </div>
</div>
</div>
    </form>
</div>
@include('components.footer')
<style>

    .container {
        max-width: 100%;
    }

    h2 {
        font-weight: bold;
        color: #d32f2f; /* rojo oscuro */
        border-bottom: 2px solid #d32f2f;
        padding-bottom: 10px;
        font-size:20px;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control, .form-select, textarea {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        background-color: #fafafa;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus, .form-select:focus, textarea:focus {
        border-color: #d32f2f;
        box-shadow: 0 0 5px rgba(211, 47, 47, 0.3);
        background-color: #fff;
    }

    .btn-primary {
        background-color: #d32f2f;
        border: none;
        font-weight: bold;
        border-radius: 25px;
        padding: 10px 30px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #b71c1c;
    }

    textarea {
        resize: vertical;
    }
</style>
