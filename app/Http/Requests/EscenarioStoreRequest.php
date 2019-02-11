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
            'tipo' => 'required|in:Futbol, Baloncesto, Voleibol, Mixta', 
            'caracteristicas' => 'required', 
            'direccion' => 'required', 
            'latitud'  => 'required|number',
            'longitud' => 'required|number', 
            'img' => 'required',
        ];
        if($this->get('img')){

            $rules = array_merge($rules,['img' => 'mimes:jpg,jpeg,png']);
        }

    }
}
