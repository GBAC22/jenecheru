<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            Vista de la Salida
        </h2>
    </x-slot>

    <div class="container mx-auto py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="block mb-8 text-center">
                <a href="{{ route('salidas.index') }}"></a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-4">
                            <table class="min-w-full divide-y divide-gray-200 w-full mb-8">
                                <tbody>
                                    <tr class="border-b bg-gray-50">
                                        <td class="px-6 py-3 text-sm font-bold text-gray-700 uppercase tracking-wider">
                                            Numero de Salida: {{ $salida->id }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            

                            <h4 class="font-semibold text-xl text-gray-800 leading-tight text-center mb-4">Detalles de Salida</h4>

                            <div class="table-responsive shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table id="detalleSalidas" class="min-w-full table table-striped divide-y divide-gray-200 w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Articulo</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Costo de Salida (PEN)</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SubTotal (PEN)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detalleSalidas as $detalleSalida)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $detalleSalida->articulo->nombre }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">s/ {{ number_format($detalleSalida->precio, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $detalleSalida->cantidad }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">s/ {{ number_format($detalleSalida->cantidad * $detalleSalida->precio, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <th colspan="3" class="text-right px-6 py-3 text-sm font-medium text-gray-500 uppercase tracking-wider">Subtotal:</th>
                                            <th class="text-right px-6 py-3 text-sm text-gray-900">s/ {{ number_format($subtotal, 2) }}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right px-6 py-3 text-sm font-medium text-gray-500 uppercase tracking-wider">TOTAL:</th>
                                            <th class="text-right px-6 py-3 text-sm text-gray-900">s/ {{ number_format($salida->total, 2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block mt-8 ">
                <a href="{{ route('salidas.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
