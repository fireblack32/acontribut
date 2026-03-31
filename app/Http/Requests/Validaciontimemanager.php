<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validaciontimemanager extends FormRequest
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
            //
            'H_Auditoria' =>   'numeric|required:timemanager|max:12',
            'H_Supervision' => 'numeric|required:timemanager|max:12',
            'H_Planeacion' =>  'numeric|required:timemanager|max:12',
	    'H_SGC' =>         'numeric|required:timemanager|max:12',
        ];
    }
}
