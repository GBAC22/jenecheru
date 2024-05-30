<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
class UpdateMarcaRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Nombre'    => [
                'string',
                'required',
            ],
            'Creacion' => [
                'required',
                'unique:Marca,Creacion,' . request()->route('marc')->id,
            ],        
        ];

           
    }
    // public function authorize1()
    // {
    //     return Gate::allows('user_access');
    // }  
}
