<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreMarcaRequests;
use App\Http\Requests\UpdateMarcaRequests;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Gate;
use App\Models\marca;

class MarcaController extends Controller
{ 
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $Marca = marca::all();
        return view('Marca.index',compact('Marca'));
    }

   
    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('Marca.create');
    }

    public function store(StoreMarcaRequests $request)
    {
        
        $marc=marca::create([
            'Nombre'=>$request->nombre,
            'Creacion'=>$request->Creacion
        ]);
        return view('Marca.index');
    }
      public function show(marca $marc)
    {
        
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('Marca.show',compact('marc'));
    }

  
    public function edit(int $id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc=marca::find($id);
        return view('Marca.edit',compact('marc'));
    }

   
    public function update(UpdateMarcaRequests $request,int $id)
    {
        $marc=marca::find($id);
        $marc->update($request->all());
        return redirect()->route('Marca.index');
    }

  

 
    public function destroy(int $id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc=marca::find($id);
        $marc->delete();
        return redirect()->route('Marca.index');
    }  

}
