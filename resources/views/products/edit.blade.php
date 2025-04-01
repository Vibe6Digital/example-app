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
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </div>

        {{-- Alert Messages --}}
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h4>Edit Product</h4>
            </div>
            <div class="card-body shadow-lg">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Product Name --}}
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" name="name" id="productName" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" placeholder="Enter product name">
                        @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea name="description" id="productDescription" class="form-control @error('description') is-invalid @enderror" placeholder="Enter description">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" name="price" id="productPrice" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" placeholder="Enter price">
                        @error('price')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stock --}}
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="productStock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" placeholder="Enter stock quantity">
                        @error('stock')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <input type="text" name="category" id="productCategory" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $product->category) }}" placeholder="Enter category">
                        @error('category')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- SKU --}}
                    <div class="mb-3">
                        <label for="productSKU" class="form-label">SKU</label>
                        <input type="text" name="sku" id="productSKU" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $product->sku) }}" placeholder="Enter SKU">
                        @error('sku')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Current Image --}}
                    @if ($product->image)
                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <div>
                            <img src="{{ asset('uploads/products/' . $product->image) }}" width="120" height="80" alt="Product Image">
                        </div>
                    </div>
                    @endif

                    {{-- New Image --}}
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Upload New Image</label>
                        <input type="file" name="image" id="productImage" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="productStatus" class="form-label">Status</label>
                        <select name="status" id="productStatus" class="form-select @error('status') is-invalid @enderror">
                            <option value="Active" {{ old('status', $product->status) == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ old('status', $product->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Update Product</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
