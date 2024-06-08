<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Carrito de Compras
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex justify-end mb-8">
            <a href="{{ route('checkout') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Seguir Comprando</a>
            <form id="paymentForm" action="{{ route('session') }}" method="POST">
                @csrf
                @foreach($cartItems as $item)
                    @if(isset($item['id']))
                        <input type="hidden" name="articulo_id[]" value="{{ $item['id'] }}">
                        <input type="hidden" name="articulo_quantity[{{ $item['id'] }}]" value="{{ $item['quantity'] }}">
                    @endif
                @endforeach
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Pagar</button>
            </form>
        </div>

        <div class="flex justify-center">
            <div class="overflow-x-auto lg:overflow-visible">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($cartItems as $item)
                                    @if(isset($item['id']))
                                        @php
                                            $itemTotal = $item['price'] * $item['quantity'];
                                            $total += $itemTotal;
                                        @endphp
                                        
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-8 w-8 rounded-full">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['name'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ $item['price'] }}</td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <form action="{{ route('update_cart') }}" method="POST" class="inline update-cart-form">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                    <div class="input-group">
                                                        <button type="button" class="btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded-l decrease-quantity">-</button>
                                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="3" class="form-control text-center update-cart-quantity" style="width: 50px; border: 1px solid #D1D5DB;" readonly>
                                                        <button type="button" class="btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded-r increase-quantity">+</button>
                                                    </div>
                                                </form>
                                                
                                            </td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ $itemTotal }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <form action="{{ route('remove_from_cart') }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-right font-bold text-sm text-gray-900">Total a cancelar:</td>
                                    <td class="px-6 py-4 font-bold text-sm text-gray-900">${{ $total }}</td>
                                    <td class="px-6 py-4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white text-center py-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.update-cart-quantity').forEach(element => {
            element.addEventListener('change', function() {
                this.closest('.update-cart-form').submit();
            });
        });

        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', function() {
                let input = this.parentElement.querySelector('.update-cart-quantity');
                if (parseInt(input.value) < 3) {
                    input.value = parseInt(input.value) + 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });

        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', function() {
                let input = this.parentElement.querySelector('.update-cart-quantity');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });
    </script>
</x-app-layout>