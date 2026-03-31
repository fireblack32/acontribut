<?php

namespace App\Http\Requests;

use App\Rules\ValidarCampourl;
use Illuminate\Foundation\Http\FormRequest;


class Validacionmenu extends FormRequest
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
        return [
          //'nombre' => 'required|max:100|unique:menu,nombre,' . $this->route('id'),
            'nombre' => 'required|max:100|unique:menu,nombre,'.$this->route('id'),
            'url' => ['required','max:50',new ValidarCampourl],
            'perfil' => 'required|max:10',
            'instancia' => 'required|max:10',
            'icono' => 'nullable|max:100'
        ];
    }
   // public function messages()
    //{
     //   return [

      //      'nombre.required' => 'Un nombre es requerido',
      //      'url.required' => 'El campo url es requerido',
      //      'perfil.required' => 'El perfil es requerido'
            
                
       //     ];


//    }
}
