<!-- resources/views/articulos/index.blade.php -->
<x-app-layout>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Artículos Disponibles
            </h2>
            <div class="dropdown">
                <button id="dLabel" type="button" class="btn btn-primary" data-bs-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="bg-red-500 text-white rounded-full px-2 py-1">{{ count(session('cart', [])) }}</span>
                </button>
    
                <div class="dropdown-menu dropdown-menu-end p-3 shadow-lg" aria-labelledby="dLabel" style="width: 300px;">
                    <h6 class="dropdown-header text-center">Artículos en el carrito</h6>
    
                    @php
                        $cartItems = session('cart', []);
                        $total = array_sum(array_map(function($item) {
                            return $item['price'] * $item['quantity'];
                        }, $cartItems));
                    @endphp
    
                    @if (count($cartItems) > 0)
                        @foreach($cartItems as $item)
                            <div class="dropdown-item p-2 mb-2 shadow-sm rounded d-flex align-items-center">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="img-fluid rounded me-2" style="width: 50px; height: 50px;">
                                <div class="flex-grow-1">
                                    <p class="mb-0">{{ $item['name'] }}</p>
                                    <small class="text-muted">Cantidad: {{ $item['quantity'] }}</small>
                                </div>
                                <div class="text-end">
                                    <p class="mb-0">${{ $item['price'] }}</p>
                                </div>
                            </div>
                        @endforeach
    
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item p-2 shadow-sm rounded text-end">
                            <p class="mb-0"><strong>Total: ${{ $total }}</strong></p>
                        </div>
                        <div class="dropdown-item text-center">
                            <a href="{{ route('pagos.carrito-index') }}" class="btn btn-primary btn-sm w-100">Revisar</a>
                        </div>
                    @else
                        <div class="dropdown-item p-2 shadow-sm rounded text-center">
                            <p class="mb-0 text-muted">El carrito está vacío</p>
                        </div>
                    @endif
                    
                </div>
                
            </div>
        </div>
    </x-slot>
    

    <div class="bg-gray-100">
        @if (session('success'))
            <div class="bg-green-500 text-white text-center py-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <div class="container my-5">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                @foreach ($articulos as $articulo)
                    <div class="col">
                        <div class="card h-100 d-flex flex-column">
                            <img src="{{ $articulo->imagen }}" class="card-img-top"
                                alt="Imagen de {{ $articulo->nombre }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $articulo->nombre }}</h5>
                                <p class="card-text"><strong>Precio: $</strong> {{ $articulo->precio_unitario }}</p>
                                <p class="card-text">{{ $articulo->descripcion }}</p>
                                
                                <form action="{{ route('add_to_cart') }}" method="POST" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $articulo->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="btn btn-primary w-100" type="submit">Añadir al carrito</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>



