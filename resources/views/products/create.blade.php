@extends('layouts.app')

@section('content')
<h1>Create a Product</h1>
<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <label>Title</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
    </div>
    <div class="form-row">
        <label>Description</label>
        <input type="text" class="form-control" name="description" value="{{ old('description') }}" required>
    </div>
    <div class="form-row">
        <label>Price</label>
        <input type="number" min="1.00" step="0.01" class="form-control" name="price" value="{{ old('price') }}"
            required>
    </div>
    <div class="form-row">
        <label>Stock</label>
        <input type="number" min="0" class="form-control" name="stock" value="{{ old('stock') }}" required>
    </div>
    <div class="form-row">
        <label>Status</label>
        <select name="status" class="custom-select">
            <option value="" selected>Select...</option>
            <option {{ old('status')=='available' ? 'selected' : '' }}value="available">Available</option>
            <option {{ old('status')=='unavailable' ? 'selected' : '' }}value="unavailable">Unavailable</option>
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
        <button class="btn btn-primary btn-lg mt-3" type="submit">Create Product</button>
    </div>
</form>
@endsection