<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles de Venta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Detalles de la Venta
                    </div>

                    <div class="mt-6 text-gray-500">
                        <div class="flex">
                            <div class="w-1/2">
                                <p><span class="font-semibold">Cliente:</span> {{ $venta->cliente->nombre }}</p>
                                <p><span class="font-semibold">Fecha:</span> {{ $venta->fecha }}</p>
                                <p><span class="font-semibold">Total:</span> ${{ $venta->total }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold">Artículos:</h3>
                            <ul class="list-disc pl-5 mt-2">
                                @foreach ($venta->articulos as $articulo)
                                    <li>{{ $articulo->nombre }} - Cantidad: {{ $articulo->pivot->cantidad }}, Precio Unitario: ${{ $articulo->pivot->precio_unitario }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
