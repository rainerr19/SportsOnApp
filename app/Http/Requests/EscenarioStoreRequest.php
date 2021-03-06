<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EscenarioStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required', 
            'paga' => 'required',
            'tipo' => 'required|in:Futbol,Baloncesto,Voleibol,Mixta', 
            'caracteristicas' => 'required', 
            'direccion' => 'required', 
            'latitud'  => 'numeric|required',
            'longitud' => 'numeric|required', 
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
        // if($this->get('imagen')){

        //     $rules = array_merge($rules,['img' => 'mimes:jpg,jpeg,png']);
        // }
        return $rules;
    }
}
