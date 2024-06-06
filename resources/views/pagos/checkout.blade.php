<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Artículos Disponibles
        </h2>
    </x-slot>


    <body class="bg-gray-100">
        <div class="max-w-4xl mx-auto py-10 px-4">
            @if (session('success'))
                <div class="bg-green-500 text-white text-center py-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <head>
                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                    crossorigin="anonymous">
                <!-- Bootstrap JavaScript -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
                </script>
                <style>
                    .card img {
                        height: 150px;
                        object-fit: cover;
                    }

                    .card-body {
                        padding: 1rem;
                    }
                </style>
            </head>

            <body>
                <div class="container my-5">
                    <form id="paymentForm" action="{{ route('session') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-success btn-lg">COMPRAR</button>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                            @foreach ($articulos as $articulo)
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="{{ $articulo->imagen }}" class="card-img-top"
                                            alt="Imagen de {{ $articulo->nombre }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $articulo->nombre }}</h5>
                                            <p class="card-text"><strong>Precio: $</strong>
                                                {{ $articulo->precio_unitario }}</p>
                                            <p class="card-text">{{ $articulo->descripcion }}</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="articulo_id[]"
                                                    value="{{ $articulo->id }}" id="articulo{{ $articulo->id }}">
                                                <label class="form-check-label" for="articulo{{ $articulo->id }}">
                                                    Seleccionar
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>

            </body>

        </div>

    </body>

</x-app-layout>
