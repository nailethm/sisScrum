<?php

namespace sisScrum\Http\Requests;

use sisScrum\Http\Requests\Request;

class AvanceTareaFormRequest extends Request
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
            'comentario'=>'required|max:256',
            'htrabajada'=>'required|numeric',
        ];
    }
}
