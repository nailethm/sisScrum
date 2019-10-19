<?php

namespace sisScrum\Http\Requests;

use sisScrum\Http\Requests\Request;

class HistoriaFormRequest extends Request
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
            // 'idsprint'=>'required',
            // 'idsprint'=>'required',
            'actor'=>'required|max:45',
            'requerimiento'=>'required|max:256',
            'funcionalidad'=>'required|max:256',
            'prioridad'=>'required',
            'notas'=>'max:256'
        ];
    }
}
