<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Products
        </h2>
</x-slot>

<div class="row">
    @foreach($products as $product)
    <div class="col s12 m4">
        <div class="card">
            <div class="card-content">
                <span class="card-title">{{ $product->name }}</span>
                <p>{{ $product->description }}</p>
            </div>
            <div class="card-action">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    {{ $products->links('pagination::bootstrap-4') }}
</div>
</x-app-layout>