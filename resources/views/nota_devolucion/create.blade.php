<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nota de Devolucion') }}
        </h2>
    </x-slot>
    <div class="py-12 ">
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'nota_devolucion.store']) !!}
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        {!! Form::label('fecha', 'Fecha', ['class' => "block font-bold text-lg text-gray-700 mb-2"]) !!}
                                        {!! Form::date('fecha', null, ['class' => "form-input rounded-md shadow-sm mt-1 block w-full"]) !!}
                                        @error('fecha')
                                            <p class="text-sm text-red-600">El campo es obligatorio</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="px-4 py-5 bg-white sm:p-6">
                            {!! Form::label('descripcion', 'Descripcion', ['class' => "block font-bold text-lg text-gray-700 mb-2"]) !!}
                            {!! Form::text('descripcion', null, ['class' => "form-input rounded-md shadow-sm mt-1 block w-full", 'placeholder' => 'Agregar Descripcion']) !!}
                            @error('descripcion')
                                <p class="text-sm text-red-600">El campo es obligatorio</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            {!! Form::label('cantidad', 'Cantidad', ['class' => "block font-bold text-lg text-gray-700 mb-2"]) !!}
                            {!! Form::text('cantidad', null, ['class' => "form-input rounded-md shadow-sm mt-1 block w-full", 'placeholder' => 'Agregar Cantidad']) !!}
                            @error('cantidad')
                                <p class="text-sm text-red-600">El campo es obligatorio</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            {!! Form::label('precio', 'Precio', ['class' => "block font-bold text-lg text-gray-700 mb-2"]) !!}
                            {!! Form::text('precio', null, ['class' => "form-input rounded-md shadow-sm mt-1 block w-full", 'placeholder' => 'Agregar Precio']) !!}
                            @error('precio')
                                <p class="text-sm text-red-600">El campo es obligatorio</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            {!! Form::label('importe', 'Importe', ['class' => "block font-bold text-lg text-gray-700 mb-2"]) !!}
                            {!! Form::text('importe', null, ['class' => "form-input rounded-md shadow-sm mt-1 block w-full", 'placeholder' => 'Agregar Importe']) !!}
                            @error('importe')
                                <p class="text-sm text-red-600">El campo es obligatorio</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            {!! Form::label('estado', 'Estado', ['class' => "block font-bold text-lg text-gray-700 mb-2"]) !!}
                            {!! Form::text('estado', null, ['class' => "form-input rounded-md shadow-sm mt-1 block w-full", 'placeholder' => 'Agregar Estado']) !!}
                            @error('estado')
                                <p class="text-sm text-red-600">El campo es obligatorio</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            {!! Form::label('cliente', 'Cliente', ['class' => "block font-bold text-lg text-gray-700 mb-2"]) !!}
                            {!! Form::select('usuario_id', $usuario, null, ['class' => "form-input rounded-md shadow-sm mt-1 block w-full"]) !!}
                            @error('articulo_id')
                                <p class="text-sm text-red-600">El campo es obligatorio</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            {!! Form::label('articulo_id', 'Articulo', ['class' => "block font-bold text-lg text-gray-700 mb-2"]) !!}
                            {!! Form::select('articulo_id', $articulo, null, ['class' => "form-input rounded-md shadow-sm mt-1 block w-full"]) !!}
                            @error('articulo_id')
                                <p class="text-sm text-red-600">El campo es obligatorio</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 sm:px-6">
                            <div class="flex-1">
                                <a href="{{ route('nota_devolucion.index') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Cancelar
                                </a>
                            </div>
                        
                            <div class="flex-1 text-right">
                                <button
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>