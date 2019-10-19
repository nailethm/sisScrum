<?php

namespace sisScrum\Http\Requests;

use sisScrum\Http\Requests\Request;

class UsuarioFormRequest extends Request
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'admin' => 'boolean',
            'CI' => 'numeric|max:7',
            'company' => 'max:255',
            'occupation' => 'max:255',
            'address' => 'max:255',
            'phone' => 'numeric|max:8',
            'status' => 'boolean',
        ];
    }    
}
