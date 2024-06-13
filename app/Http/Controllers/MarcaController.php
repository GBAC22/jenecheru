<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreMarcaRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Gate;
use App\Models\marca;

class MarcaController extends Controller
{ 

    
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marcs = marca::all();
        return view('marca.index',compact('marcs'));
    }

   
    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('marca.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([

            'nombre'=> 'required|string|min:1|max:200',
            'creacion' => 'required|string|min:1'
        ]);
        marca::create($request->all());
            
        return redirect()->route('marca.index');
          
    }
      public function show(int $id)
    {
        
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc=marca::findOrFail($id);
        return view('marca.show',compact('marc'));
    }

  
    public function edit(int $id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc=marca::find($id);
        return view('marca.edit',compact('marc'));
    }

   
    public function update(Request $request,int $id)
    {              
        $request->validate([
            'nombre'=> 'required|string|min:1|max:200',
            'creacion' => 'required|string|min:1'
        ]);

        $marc=marca::find($id);
        $marc->update($request->all());
        return redirect()->route('marca.index'); //sa
    }

 
    public function destroy(int $id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marc=marca::find($id);           
        $marc->delete();   
        return redirect()->route('marca.index');
      
    }  
}
