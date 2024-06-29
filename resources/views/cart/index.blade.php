<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            My Cart
        </h2>
</x-slot>

<div class="row">
    @if($items->isEmpty())
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Your Cart is Empty
                </div>
            </div>
        </div>
    </div>
    @else
        @foreach($items as $item)
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">{{ $item->product->name }}</span>
                        <p>{{ $item->product->description }}</p>
                        <p>Quantity: {{ $item->quantity}}</p>
                        <p>Price: {{ $item->product->price}}</p>
                        <p>Total: {{ $item->product->price * $item->quantity}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
</x-app-layout>