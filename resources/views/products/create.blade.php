<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My CURD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="bg-dark text-center text-white py-3">
    <h3>My CURD App</h3>
</div>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <a href="/products" class="btn btn-dark">Back</a>
    </div>
  @if(Session::has('error'))<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Unable to add product.
  {{ Session::get('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>@endif

  @if(Session::has('success'))<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>
  {{ Session::get('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>@endif
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h4>Add Products</h4>
        </div>
        <div class="card-body shadow-lg">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input value="{{old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="productName" placeholder="Enter product name">
                    @error('name')
                       <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="productDescription" placeholder="Enter description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="productPrice" placeholder="Enter price" value="{{ old('price') }}">
                    @error('price')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productStock" class="form-label">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="productStock" placeholder="Enter stock quantity" value="{{ old('stock') }}">
                    @error('stock')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productCategory" class="form-label">Category</label>
                    <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" id="productCategory" placeholder="Enter category" value="{{ old('category') }}">
                    @error('category')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productSKU" class="form-label">SKU</label>
                    <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" id="productSKU" placeholder="Enter SKU" value="{{ old('sku') }}">
                    @error('sku')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productImage" class="form-label">Upload Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="productImage">
                    @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="productStatus" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status" id="productStatus">
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Add Product</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
