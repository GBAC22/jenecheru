<!-- resources/views/proveedores/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Proveedores
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 relative">
        <!-- Botón para crear nuevo proveedor -->
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('proveedores.create') }}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Crear Proveedor</a>
        </div>

        <!-- Eliminado el campo de búsqueda según la solicitud -->

        <!-- Mensaje de éxito -->
        @if ($message = Session::get('success'))
            <!-- Cuadro de éxito en la esquina inferior derecha -->
            <div id="successMessage"
                class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow"
                role="alert">
                <span class="block sm:inline">{{ $message }}</span>
            </div>

            <!-- Script para ocultar el mensaje de éxito después de 3 segundos -->
            <script>
                setTimeout(function() {
                    var element = document.getElementById('successMessage');
                    if (element) {
                        element.remove();
                    }
                }, 3000); // 3000 milliseconds = 3 seconds
            </script>
        @endif

        <div class="flex justify-center">
            <div class="overflow-x-auto lg:overflow-visible">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Teléfono
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dirección
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($proveedores as $proveedor)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $proveedor->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $proveedor->nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $proveedor->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $proveedor->telefono }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $proveedor->direccion }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('proveedores.show', $proveedor->id) }}"
                                                class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Ver</a>
                                            <a href="{{ route('proveedores.edit', $proveedor->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Editar</a>
                                            <form class="inline-block"
                                                action="{{ route('proveedores.destroy', $proveedor->id) }}"
                                                method="POST" onsubmit="return confirm('¿Estás seguro?');">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit"
                                                    class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                    value="Eliminar">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
