<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-dark text-center text-white py-5">
        <h1>Welcome to My CRUD App</h1>
        <p class="lead">Manage your products with ease</p>
    </div>

    <div class="container mt-5">
        <div class="text-center">
            <p class="mb-4">Click below to start managing your products</p>
            <a href="{{ route('products.index') }}" class="btn btn-dark btn-lg">
                Go to Products
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>