@extends('layouts.app')

@section('content')
    <h1>List of Products</h1>

    <a href="{{ route('products.create') }}" target="_blank" class="btn btn-success mb-3">Create</a>

    @empty ($products)
        <div class="alert alert-warning">
            The list of products is empty
        </div>
    @else
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                        <a href="{{ route('products.show', ['product' => $product->id]) }}" target="_blank" class="btn btn-link">Show</a> 
                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" target="_blank" class="btn btn-link">Edit</a> 
                        <form action="{{ route('products.destroy', ['product' => $product->id]) }}" class="d-inline" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endempty
@endsection