<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Venta
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('ventas.update', $venta->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="cliente_id" class="block font-medium text-sm text-gray-700">Cliente</label>
                            <select name="cliente_id" id="cliente_id" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" @if ($cliente->id == $venta->cliente_id) selected @endif>{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="fecha" class="block font-medium text-sm text-gray-700">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $venta->fecha }}" />
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="total" class="block font-medium text-sm text-gray-700">Total</label>
                            <input type="number" step="0.01" name="total" id="total" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $venta->total }}" />
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label class="block font-medium text-sm text-gray-700">Artículos</label>
                            <div class="grid grid-cols-3 gap-4 mt-2">
                                @foreach ($articulos as $articulo)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="articulos[{{ $articulo->id }}][id]" id="articulo_{{ $articulo->id }}" value="{{ $articulo->id }}"
                                            @foreach ($venta->articulos as $ventaArticulo)
                                                @if ($ventaArticulo->id == $articulo->id) checked @endif
                                            @endforeach
                                            class="form-checkbox h-5 w-5 text-indigo-600">
                                        <label for="articulo_{{ $articulo->id }}" class="ml-2 text-sm text-gray-700">{{ $articulo->nombre }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('ventas.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 active:bg-indigo-700 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo disabled:opacity-25 transition ease-in-out duration-150">
                                Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
