<div class="card">
    <img src="{{ asset($product->images->first()->path) }}" alt="" class="card-img-top" height="500">
    <div class="card-body">
        <h4 class="text-right"><strong>${{ $product->price }}</strong></h4>
        <h5 class="card-title">{{ $product->title }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text"><strong>{{ $product->stock }} left</strong></p>
        @if (isset($cart))
        <form class="d-inline" method="POST" action="{{ route('products.carts.destroy', ['cart' => $cart->id, 'product' => $product->id]) }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-warning">Remove from cart</button>
        </form>

        @else
        <form class="d-inline" method="POST" action="{{ route('products.carts.store', ['product' => $product->id]) }}">
            @csrf
            <button type="submit" class="btn btn-success">Add to cart</button>
        </form>

        @endif
    </div>
</div>