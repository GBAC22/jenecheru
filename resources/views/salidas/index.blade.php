@can('user_access')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nota de Salida
        </h2>
    </x-slot>
    <div>
        

    </table>
    @if(session('success'))
        <div id="success-message" class="alert alert-success text-green-600 bg-green-200 border border-green-200 p-4 my-4">
            {{ session('success') }}
        </div>
    @endif
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 2000); // Ocultar el mensaje después de 2 seg
    </script>
    
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8 " >
            <div class="block mb-8">
            
                <a href="{{ route('salidas.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Registrar una Salida</a>
          
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider ">
                                        ID
                                    </th>
                                    <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha
                                    </th>  
                                    <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>                                   
                                     <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>   
                                    <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descripcion
                                    </th>  
                                  
                                     <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>                                                                                              
                                </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($salidas as $salida)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $salida->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $salida->fecha }}
                                        </td>          
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $salida->total }}
                                        </td>                             

                                       
                                        @if ($salida->status=='VALIDO')
                                        <td>
                                            <a class="text-green-600 bg-green-200 border border-green-200" href="{{ route('salidas.change_status', $salida) }}" title="Editar">
                                                ACTIVO <i class="fas fa-check"></i>
                                            </a>
                                        </td>  
                                    @else  
                                        <td>
                                            <a class="text-red-600 bg-red-200 border border-red-200" href="{{ route('salidas.descrip', $salida) }}" title="Editar">
                                                CANCELADO <i class="fas fa-times"></i>
                                            </a>
                                        </td> 
                                    @endif

                                    @if ($salida->descripcion=='ARTICULO OBSOLETO')
                                    <td>
                                        <a class="text-gray-700 bg-gray-300 border border-gray-300" href="{{ route('salidas.descrip', $salida) }}" title="Editar">
                                            Articulo obsoleto <i class="fas fa-check"></i>
                                        </a>
                                    </td>  
                                @else  
                                    <td>
                                        <a class="text-gray-600 bg-gray-200 border border-gray-200" href="{{ route('salidas.descrip', $salida) }}" title="Editar">
                                            Articulo dañado <i class="fas fa-times"></i>
                                        </a>
                                    </td> 
                                @endif
                                        
                                  
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <img src="/imagen/{{$salida->imagen}}" width="30%">
                                        </td>                                         --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('salidas.pdf', $salida) }}" class="text-green-600 hover:text-green-900 mb-2 mr-2">PDF</a>
                                                                                           
                                            <a href="{{ route('salidas.show', $salida->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
              
                                            <form class="inline-block" action="{{ route('salidas.destroy', $salida->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')                                                
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
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
    </div>
</x-app-layout>
@endcan
