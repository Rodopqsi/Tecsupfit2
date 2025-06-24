<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="search-bar w-75">
        <i class="fas fa-search"></i>
        <input type="text" class="form-control" placeholder="Buscar productos..." id="searchInput">
    </div>
    <button class="btn btn-outline-primary" onclick="window.location.href='{{ url('/') }}'">
        <i class="fas fa-eye me-2"></i>Ver Tienda
    </button>
    <button class="btn btn-primary toggle-sidebar d-none">
        <i class="fas fa-bars"></i>
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif