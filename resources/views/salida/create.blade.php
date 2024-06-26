<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Salidas
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('salidas.store') }}" enctype="multipart/form-data">
                     @csrf {{--  protege app contra ataques --}}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="articulo_id" class="block font-medium text-sm text-gray-700">Articulo</label>
                            <select  name="articulo_id" id="articulo_id" class="form-input rounded-md shadow-sm mt-1 block w-full"                                    />
                              <option value="" disabled selected>Seleccione un articulo</option>
                              @foreach($articulos as $articulo)                            
                                <option value="{{ $articulo->id }}_{{ $articulo->stock }}">{{ $articulo->nombre }} </option>
                              @endforeach
                            </select>
                        </div>
                       
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="name" class="block font-medium text-sm text-gray-700">Stock actual</label>
                            <input type="text" name="" id="stock" value="" class="form-input rounded-md shadow-sm mt-1 block w-full "disabled/>
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="name" class="block font-medium text-sm text-gray-700">Cantidad</label>
                            <input type="text" name="cantidad" id="cantidad" class="form-input rounded-md shadow-sm mt-1 block w-full"                                    />
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="name" class="block font-medium text-sm text-gray-700">Descripcion</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-input rounded-md shadow-sm mt-1 block w-full"                                    />
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <button type = "button" id="agregar" class="btn btn-primary float-right   w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"> Agregar Articulo </button>
                        </div>

                        {{-- <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="name" class="block font-medium text-sm text-gray-700">Agregar</label>
                            <input type="text" name="cantidad" id="cantidad" class="form-input rounded-md shadow-sm mt-1 block w-full"                                    />
                        </div> --}}
                        <div class="px-4 py-5 bg-white sm:p-6">
                             <h4 class="card-tittle py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"> Detalles de Salida</h4>
                             <div class="table-responsive col-md-12 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table id="detalles" class="table table-striped min-w-full divide-y divide-gray-200 w-full">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> Eliminar</th>
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> Articulo</th>
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> Cantidad</th>
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> Descripcion</th>
                                        </tr>  
                                    </thead>
                                </table>                              
                            </div>        
                        </div>
                        


                        <div class="px-4 py-5 bg-white sm:p-6 mt-5 mx-7">
                            <img id="imagenSeleccionada" style="max-height: 300px;">
                        </div>


                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Subir Imagen</label>
                                <div class='flex items-center justify-center w-full'>
                                    <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                        <div class='flex flex-col items-center justify-center pt-7'>
                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class='text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Seleccione la imagen</p>
                                        </div>
                                    <input name="imagen" id="imagen" type='file' class="hidden" />
                                    </label>
                                </div>
                        </div>

                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            {{-- <button type="submit" id="guardar" class="btn btn-primary float-right">Registrar</button> --}}
                            <a href="{{ route('salidas.index') }}" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                            <button type="submit" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Guardar</button>
                        </div>                                         
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script>   
    $(document).ready(function (e) {   
        $('#imagen').change(function(){            
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#imagenSeleccionada').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });
</script>

<script>
    $(document).ready(function(){
        $("#agregar").click(function(){
        });        
    });
    var total=0;
    var cont=1;
    $("#guardar").hide();
    $("#articulo_id").change(mostrarValores)
    function mostrarValores()
    {
        datosArticulo= document.getElementById('articulo_id').value.split('_');
        $("#stock").val(datosArticulo[2]);
    }
    function agregar()
    {
        datosArticulo = document.getElementById('articulo_id').value.split('_');

        articulo_id=datosArticulo[0];
        articulo=$("#articulo_id option:selected").text();
        cantidad=$("#cantidad").val();
        stock=$("#stock").val();
        if(articulo_id!="" && cantidad!="" && cantidad>0 && ){
            if(parseInt(stock)>=parseInt(cantidad)){
                var fila= <tr class="selected" id="fila' +cont+ '"><td><button 
                type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');
                "><i class="fa fa-times fa 2x"></i></button></td> <td><input type="hidden"
                name="articulo_id[]" value="'+articulo_id+'">' + articulo + '</td> <td>
                <input type="hidden" name="cantidad[]" value="'+cantidad+'"> <input 
                type="number" value="'+cantidad+'" class="form-control"disabled> </td> </tr>;

                cont++;
                limpiar();
                 totales();
                evaluar();
                $('#detalles').append(fila);
            }else{
                Swal.fire({
                    type: 'error',
                    text: 'La cantidad supera al Stock. ',
                })
            }
        }else{
            Swal.fire({
                type: 'error',
                text: 'Rellene todos los campos del detalle de la salida. ',
            })
        }
    }
    function limpiar(){
        $("#cantidad").val("");
    }
    function evaluar() {
        if(total>0)
        {
            $("#guardar").show();
        }else{
            $("#guardar").hide();
        }
    }

   function eliminar(index){  }
</script>




