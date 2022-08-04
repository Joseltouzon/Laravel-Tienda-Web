@extends('layouts.master')

@section('content')
<h1>Edit a Product</h1>
<form action="{{ route('products.update', ['product' => $product->id]) }}" method="post">
    @csrf {{-- necesario para poder mandar o recibir info --}}
    @method('PUT') {{-- convierte el metodo post en put --}}
    <div class="form-row">
        <label>Title</label>
        <input type="text" class="form-control" value="{{ $product->title}}" name="title" required>
    </div>
    <div class="form-row">
        <label>Description</label>
        <input type="text" class="form-control" value="{{ $product->description }}" name="description" required>
    </div>
    <div class="form-row">
        <label>Price</label>
        <input type="number" min="1.00" step="0.01" class="form-control" value="{{ $product->price }}" name="price"
            required>
    </div>
    <div class="form-row">
        <label>Stock</label>
        <input type="number" min="0" class="form-control" value="{{ $product->stock }}" name="stock" required>
    </div>
    <div class="form-row">
        <label>Status</label>
        <select name="status" class="custom-select">
            <option {{ $product->status == 'available' ? 'selected' : '' }} value="available">Available</option>
            <option {{ $product->status == 'unavailable' ? 'selected' : '' }} value="unavailable">Unavailable</option>
        </select>
    </div>
    <div class="form-row">
        <button class="btn btn-primary btn-lg" type="submit">Edit Product</button>
    </div>
</form>
@endsection