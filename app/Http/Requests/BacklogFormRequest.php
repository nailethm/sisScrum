<?php

namespace sisScrum\Http\Requests;

use sisScrum\Http\Requests\Request;

class BacklogFormRequest extends Request
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
            'idproyecto'=>'required',
            'estado'=>'required|max:20'
        ];
    }
}
