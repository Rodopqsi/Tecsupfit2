<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administrativo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    @stack('styles')
    
    <style>
        
    .sidebar {
      width: var(--sidebar-width);
      background-color: var(--primary-color);
      color: white;
      padding: 0;
      display: flex;
      flex-direction: column;
      transition: all 0.3s;
    }
    
    .sidebar-header {
      padding: 20px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    
    .sidebar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 1.2rem;
      font-weight: 600;
    }
    
    .sidebar-brand img {
      height: 40px;
    }
    
    .sidebar-menu {
      flex: 1;
      padding: 20px 0;
      overflow-y: auto;
    }
    
    .nav-item {
      margin-bottom: 5px;
    }
    
    .nav-link {
      color: rgba(255,255,255,0.8);
      padding: 12px 20px;
      border-left: 3px solid transparent;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .nav-link:hover, .nav-link.active {
      color: white;
      background-color: rgba(255,255,255,0.1);
      border-left-color: var(--accent-color);
    }
    
    .nav-link i {
      width: 20px;
      text-align: center;
    }
    
    .dropdown-menu {
      background-color: var(--secondary-color);
      border: none;
      border-radius: 0;
    }
    
    .dropdown-item {
      color: rgba(255,255,255,0.8);
      padding: 8px 20px 8px 40px;
    }
    
    .dropdown-item:hover {
      background-color: rgba(255,255,255,0.1);
      color: white;
    }
         .search-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .search-bar {
        position: relative;
        width: 100%;
        max-width: 400px;
    }
    
    .search-bar input {
        padding: 12px 20px 12px 45px;
        border-radius: 25px;
        border: 2px solid #e9ecef;
        width: 100%;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .search-bar input:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    }
    
    .search-bar i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 16px;
    }
    
    .category-filters {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 15px;
    }
    
    .category-btn {
        padding: 8px 16px;
        border: 2px solid #dee2e6;
        background: white;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        color: #495057;
    }
    
    .category-btn:hover, .category-btn.active {
        background: #e74c3c;
        border-color: #e74c3c;
        color: white;
        transform: translateY(-2px);
    }
    
    .category-btn.edit-categories {
        background: #e74c3c;
        color: white;
        border-color: #e74c3c;
    }
    
    .category-btn.top-month {
        background: #ffc107;
        color: #212529;
        border-color: #ffc107;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .add-product-card {
        background: white;
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        padding: 40px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    .add-product-card:hover {
        border-color: #e74c3c;
        background: #fff5f5;
    }
    
    .add-product-card .add-icon {
        width: 50px;
        height: 50px;
        background: #e74c3c;
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 15px;
    }
    
    .product-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        position: relative;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.15);
    }
    
    .product-image {
        height: 200px;
        background: #f8f9fa;
        position: relative;
        overflow: hidden;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .product-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #28a745;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .product-info {
        padding: 20px;
    }
    
    .product-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #212529;
    }
    
    .product-description {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .product-price {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }
    
    .price-current {
        font-size: 18px;
        font-weight: bold;
        color: #e74c3c;
    }
    
    .price-old {
        font-size: 14px;
        color: #6c757d;
        text-decoration: line-through;
    }
    
    .product-meta {
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 15px;
    }
    
    .stock-info {
        margin-bottom: 15px;
    }
    
    .stock-label {
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 5px;
    }
    
    .stock-bar {
        height: 6px;
        background: #e9ecef;
        border-radius: 3px;
        overflow: hidden;
    }
    
    .stock-fill {
        height: 100%;
        background: #28a745;
        transition: width 0.3s;
    }
    
    .product-actions {
        display: flex;
        gap: 8px;
        margin-bottom: 15px;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-sm:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    
    .purchase-form {
        display: flex;
        gap: 5px;
    }
    
    .purchase-form input {
        flex: 1;
        padding: 8px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        font-size: 12px;
    }
    
    .delmes-btn {
        width: 100%;
        margin-bottom: 10px;
    }
    </style>
</head>
<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.toggle-sidebar')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
    
    @stack('scripts')
</body>
</html>