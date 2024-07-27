<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            "mdp" => "required|min:4",
            'cmdp' => 'required|min:4|same:mdp', // Ensure cmdp matches mdp
            'nom'=>'required',
            "prenom" => "required",
            "dateNaiss" => "required",
            "lieuNaiss" => "required",
            "tel" => "required",
        ];
    }
}
