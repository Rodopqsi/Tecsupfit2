<body>

    <div class="sidebar">
        @component('components.side_bar')
        @endcomponent
    </div>
<!-- Search Container -->
<section class="Contenedor_general">
<div class="container py-4">
    <h1 class="text-2xl font-bold mb-4">Listado de Reclamaciones</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <form method="GET" action="{{ route('reclamaciones.buscar') }}" class="flex flex-wrap gap-2">
            <input type="text" name="numero_documento" placeholder="Nro Documento" value="{{ request('numero_documento') }}" class="form-control" />
            <select name="estado" class="form-select">
                <option value="">-- Estado --</option>
                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_proceso" {{ request('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="resuelto" {{ request('estado') == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                <option value="cerrado" {{ request('estado') == 'cerrado' ? 'selected' : '' }}>Cerrado</option>
            </select>
            <select name="tipo_reclamo" class="form-select">
                <option value="">-- Tipo Reclamo --</option>
                <option value="reclamo" {{ request('tipo_reclamo') == 'reclamo' ? 'selected' : '' }}>Reclamo</option>
                <option value="queja" {{ request('tipo_reclamo') == 'queja' ? 'selected' : '' }}>Queja</option>
            </select>
            <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="form-control" />
            <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="form-control" />
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

    <table class="table table-bordered table-striped text-sm">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Email</th>
                <th>Producto(s)</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reclamaciones as $reclamacion)
                <tr>
                    <td>{{ $reclamacion->id }}</td>
                    <td>{{ $reclamacion->nombre_completo }}</td>
                    <td>{{ $reclamacion->email }}</td>
                    <td>{{ $reclamacion->producto }}</td>
                    <td><span class="badge {{ $reclamacion->tipo_reclamo_badge }}">{{ ucfirst($reclamacion->tipo_reclamo) }}</span></td>
                    <td><span class="badge {{ $reclamacion->estado_badge }}">{{ ucfirst($reclamacion->estado) }}</span></td>
                    <td>{{ $reclamacion->fecha_formateada }}</td>
                    <td style="display:flex; gap:10px;">
                        <a href="{{ route('reclamaciones.show', $reclamacion) }}" class="btn btn-sm btn-info">Ver</a>
                        <form action="{{ route('reclamaciones.destroy', $reclamacion) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta reclamación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No se encontraron reclamaciones.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $reclamaciones->links() }}
    </div>
</div>
</section>
<style>
    /* Contenedor principal */
    .container {
        max-width: 100%;
        padding: 1rem;
        background-color: #fff;
        color: #000;
        font-family: 'Segoe UI', sans-serif;
    }

    h1 {
        color: #d32f2f;
        font-size: 1.8rem;
        border-left: 5px solid #d32f2f;
        padding-left: 0.5rem;
    }

    /* Formulario de filtros */
    form.flex {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 8px 12px;
        min-width: 150px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #d32f2f;
        outline: none;
        background-color: #fff;
    }

    .btn-primary {
        background-color: #d32f2f;
        color: white;
        border: none;
        padding: 0.5rem 1.2rem;
        border-radius: 20px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #b71c1c;
    }

    .btn-info {
        background-color: #555;
        margin-bottom:5px;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 12px;
        text-decoration: none;
        height:30px;
    }

    .btn-danger {
        background-color: #e53935;
        color: white;
        cursor:pointer;
        border: none;
        padding: 5px 10px;
        border-radius: 12px;
        height:40px;
    }

    /* Tabla */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
        background-color: #fff;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    thead {
        background-color: #d32f2f;
        color: white;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        color: white;
    }

    .reclamo { background-color: #f44336; }
    .queja { background-color: #ff7043; }
    .pendiente { background-color: #ffa726; }
    .en_proceso { background-color: #29b6f6; }
    .resuelto { background-color: #66bb6a; }
    .cerrado { background-color: #9e9e9e; }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 0.75rem;
        border-left: 5px solid #28a745;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        table, thead, tbody, th, td, tr {
            display: block;
        }

        thead {
            display: none;
        }

        tr {
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 0.5rem;
        }

        td {
            padding: 0.5rem;
            text-align: right;
            position: relative;
        }

        td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            padding-left: 0.5rem;
            font-weight: bold;
            text-transform: capitalize;
            color: #d32f2f;
        }
    }
</style>
