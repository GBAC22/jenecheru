<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Procesar Pago
        </h2>
    </x-slot>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="bg-gray-100">
        <div class="max-w-4xl mx-auto py-10 px-4">
            @if (session('success'))
                <div class="bg-green-500 text-white text-center py-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form id="paymentForm" action="{{ route('session') }}" method="POST">
                @csrf
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded my-6">
                        <thead>
                            <tr>
                                <th
                                    class="py-2 px-4 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Código</th>
                                <th
                                    class="py-2 px-4 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Nombre</th>
                                <th
                                    class="py-2 px-4 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Imagen</th>
                                <th
                                    class="py-2 px-4 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Tipo</th>
                                <th
                                    class="py-2 px-4 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Precio</th>
                                <th
                                    class="py-2 px-4 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Descripción</th>
                                <th
                                    class="py-2 px-4 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Total</th>
                                <th
                                    class="py-2 px-4 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($articulos as $articulo)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-2 px-4">{{ $articulo->codigo }}</td>
                                    <td class="py-2 px-4">{{ $articulo->nombre }}</td>
                                    <td class="py-2 px-4"><img src="{{ $articulo->imagen }}" alt="Imagen de artículo"
                                            class="h-8 w-8 rounded-full"></td>
                                    <td class="py-2 px-4">{{ $articulo->tipo }}</td>
                                    <td class="py-2 px-4">{{ $articulo->precio_unitario }}</td>
                                    <td class="py-2 px-4">{{ $articulo->descripcion }}</td>
                                    <td class="py-2 px-4">{{ $articulo->precio_unitario }}</td>
                                    <td class="py-2 px-4 text-center"><input type="checkbox" name="articulo_id[]"
                                            value="{{ $articulo->id }}"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Comprar</button>
                </div>
            </form>
        </div>
    </body>

    </html>


</x-app-layout>
