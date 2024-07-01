@can('user_access')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Salidas
        </h2>
    </x-slot>  
    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('salidas.store') }}" >
                     @csrf {{--  protege app contra ataques --}}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="articulo_id" class="block font-medium text-sm text-gray-700">Articulo</label>
                            <select  name="articulo_id" id="articulo_id" class="form-input rounded-md shadow-sm mt-1 block w-full"                                    />
                              <option value="" disabled selected>Seleccione un articulo</option>
                              
                               @foreach($articulos as $articulo)                            
                                  <option value="{{ $articulo->id }}_{{ $articulo->stock }}_{{$articulo->precio_unitario}}">{{ $articulo->nombre }} </option>
                                @endforeach
                            </select>                            
                        </div>
                        {{-- <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="user_id" class="block font-medium text-sm text-gray-700">Usuario</label>
                            <select  name="user_id" id="user_id" class="form-input rounded-md shadow-sm mt-1 block w-full"                                    />
                              <option value="" disabled selected>Seleccione a un usuario</option>
                              
                               @foreach($users as $user)                            
                                  <option value="{{ $user->id }}">{{ $user->nombre }} </option>
                                @endforeach
                            </select>                            
                        </div> --}}
                       
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="stock" class="block font-medium text-sm text-gray-700">Stock actual</label>
                            <input type="number" name="stock" id="stock" value="" class="form-input rounded-md shadow-sm mt-1 block w-full "disabled/>
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="cantidad" class="block font-medium text-sm text-gray-700">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-input rounded-md shadow-sm mt-1 block w-full"  aria-describedby="helpId"                                    />
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="precio" class="block font-medium text-sm text-gray-700">Costo de la Salida</label>
                            <input type="number" name="precio" id="precio" class="form-input rounded-md shadow-sm mt-1 block w-full "disabled/>
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="detalle" class="block font-medium text-sm text-gray-700">Detalle</label>
                            <input type="text" name="detalle" id="detalle" class="form-input rounded-md shadow-sm mt-1 block w-full"  aria-describedby="helpId"                                    />
                        </div>
                       
                                                            
                        <div class="px-4 py-5 bg-white sm:p-6 mb-4">
                            <button type = "button" id="bt_add" class="btn btn-primary float-right   w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2" > 
                                Agregar Articulo 
                            </button>
                        </div>

                        {{-- <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="name" class="block font-medium text-sm text-gray-700">Agregar</label>
                            <input type="text" name="cantidad" id="cantidad" class="form-input rounded-md shadow-sm mt-1 block w-full"                                    />
                        </div> --}}
                         <div class="px-4 py-5 bg-white sm:p-6">
                             <h4 class="font-semibold text-xl text-gray-800 leading-tight "> Detalles de Salida </h4>
                             <div class="table-responsive col-md-12 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table id="detalles" class="table table-striped">
                                    <thead >
                                        <tr>
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> 
                                                Eliminar
                                            </th>
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> 
                                                Articulo
                                            </th>
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> 
                                                Detalle
                                            </th>
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> 
                                                Costo de Salida(PEN)
                                            </th>
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> 
                                                Cantidad
                                            </th>                                                                                                                                                                      
                                            <th scope="col" width="100" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider "> 
                                                SubTotal(PEN)
                                            </th>
                                        </tr>  
                                    </thead>
                                    
                                   
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">
                                                <p align="right"  style="text-align: left;"> TOTAL: </p>
                                            </th>
                                            <th>
                                                <p  align="right" style="text-align: left;"> <span id="total">PEN 0.00</span> </p>
                                            </th>
                                        </tr>
                                        
                                        <tr>
                                            <th colspan="4">
                                                <p align="right"  style="text-align: left;"> TOTAL A PAGAR: </p>
                                            </th>
                                            <th>
                                                <p align="right" style="text-align: left;"> <span id="total_pagar_html">PEN 0.00</span> 
                                                    <input type="hidden" name="total" id="total_pagar"> </p>
                                            </th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>                              
                            </div>        
                        </div>
                        

{{--
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
                        </div> --}}

                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            <a href="{{ route('salidas.index') }}" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                            <button type="submit" id="guardar" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Guardar</button>
                        </div>   
                                                              
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
@endcan

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
        $("#bt_add").click(function(){
            agregar();
        });        
    });
    
  
     var cont=1;
     var total=0;
     var subtotal=[];
     $("#guardar").hide();
     $("#articulo_id").change(function() {
    mostrarValores();
});

   function mostrarValores() {
    var dataProducto = $("#articulo_id").val().split('_');
    var stock = dataProducto[1];    
    $("#stock").val(stock);
    var precio = dataProducto[2];
    $("#precio").val(precio);
 
    }

    function agregar() {
    var articulo_id = $("#articulo_id").val();
    var articulo = $("#articulo_id option:selected").text();
    var cantidad = parseInt($("#cantidad").val());
    var precio = parseInt($("#precio").val());
    var detalle = $("#detalle").val();
    var stock = parseInt($("#stock").val());

    if (articulo_id != "" && cantidad > 0 ) {
        if(parseInt(stock)>=parseInt(cantidad)){             //
        subtotal[cont]=cantidad*precio;
        total=total + subtotal[cont];
                // class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                // '<i class="text-red-600 hover:text-red-900 mb-2 mr-2"> Eliminar</button></i></td>' +
                var fila = '<tr class="selected" id="fila' + cont + '" style="text-align: center; background-color: #f2f2f2; color: #333;">' +        
             '<td style="padding: 10px;"><button type="button" class="text-red-600 hover:text-red-900 mb-2 mr-2" onclick="eliminar(' + cont + ')"><i class="fa fa-times fa-2x text-xl"> X </i></button></td>'+
            '<td><input type="hidden" name="articulo_id[]" value="' + articulo_id + '">' + articulo + '</td>' +
            '<td><input type="text" name="detalle[]" value="' + detalle + '"></td>' +
            '<td><input type="number" name="precio[]" value="' + precio.toFixed(2) + '"></td>' +
            '<td><input type="number" name="cantidad[]" value="' + cantidad + '"></td>' +            
           '<td style="text-align: left;">s/' + subtotal[cont].toFixed(2) + '</td>'
           '</tr>';
       
        cont++;
        limpiar();
        totales();
        evaluar();
        $('#detalles').append(fila);
    } else {
        Swal.fire({
            type: 'error',
            text: 'LA CANTIDAD SUPERA AL STOCK.',
        });
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
        $("#detalle").val("");                 
        $("#precio").val(""); 
    }
    function totales() {
    // Aquí debes calcular el total de la salida
     
    // $("input[name='cantidad[]']").each(function() {
    //     total += parseInt($(this).val());
    // });
    // $("#total").html("PEN " + total.toFixed(2));
    $("#total").html("PEN " + total.toFixed(2));
    total_pagar=total;

    $("#total_pagar_html").html("PEN"+ total_pagar.toFixed(2));
    $("#total_pagar").val(total_pagar.toFixed(2));

}

function evaluar() {
    if (total > 0) {
        $("#guardar").show();
    } else {
        $("#guardar").hide();
    }
}

   function eliminar(index){ 
       total=total - subtotal[index];
       total_pagar_html=total;
       $("#total").html("PEN"+ total);
       $("total_pagar_html").html("PEN"+ total_pagar_html);
       $("total_pagar").val(total_pagar_html.toFixed(2));
       $("#fila" + index).remove();
       alert("Deseas eliminar el detalle de la Salida."); 
       evaluar();
   }

</script> 






{{-- 
    $(document).ready(function() {
        $('#articulo_id').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var stock = selectedOption.data('stock');
            $('#stock').val(stock);
     }); 
    }); --}}