@extends('layouts.app')

@section('content')
<h1>Edit a Product</h1>
<form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
    @csrf {{-- necesario para poder mandar o recibir info --}}
    @method('PUT') {{-- convierte el metodo post en put --}}
    <div class="form-row">
        <label>Title</label>
        <input type="text" class="form-control" value="{{ old('title') ?? $product->title}}" name="title" required>
    </div>
    <div class="form-row">
        <label>Description</label>
        <input type="text" class="form-control" value="{{ old('description') ?? $product->description }}" name="description" required>
    </div>
    <div class="form-row">
        <label>Price</label>
        <input type="number" min="1.00" step="0.01" class="form-control" value="{{ old('price') ?? $product->price }}" name="price"
            required>
    </div>
    <div class="form-row">
        <label>Stock</label>
        <input type="number" min="0" class="form-control" value="{{ old('stock') ?? $product->stock }}" name="stock" required>
    </div>
    <div class="form-row">
        <label>Status</label>
        <select name="status" class="custom-select">
            <option {{ old('status') == 'available' ? 'selected' : ($product->status == 'available' ? 'selected' : '') }} value="available">Available</option>
            <option {{ old('status') == 'unavailable' ? 'selected' : ($product->status == 'unavailable' ? 'selected' : '') }} value="unavailable">Unavailable</option>
        </select>
    </div>
    <div class="from-row">
        <label>{{ __('Images') }}</label>
        <div class="custom-file">
            <input type="file" accept="image/*" name="images[]" class="form-control" multiple>
            <label class="custom-file-label">
                Product images ...
            </label>
        </div>
    </div>
    <div class="form-row">
        <button class="btn btn-primary btn-lg mt-3" type="submit">Edit Product</button>
    </div>
</form>
@endsection