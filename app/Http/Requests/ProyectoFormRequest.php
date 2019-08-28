<?php

namespace sisScrum\Http\Requests;

use sisScrum\Http\Requests\Request;

class ProyectoFormRequest extends Request
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
            'nombre'=>'required|max:50',
            'descripcion'=>'max:256',
            // 'inicio_proyecto' => 'nullable|date',
            // 'fin_proyecto' => 'nullable|date'
        ];
    }
}
