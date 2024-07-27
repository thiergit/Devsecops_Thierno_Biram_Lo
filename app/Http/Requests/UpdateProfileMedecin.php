<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileMedecin extends FormRequest
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
                //'email' => 'required|email|unique:users',
                'nom'=>'required',
                "prenom" => "required",
                "dateNaiss" => "required",
                "tel" => "required",
                "lieuNaiss" => "required",
                "centre" => "nullable",
                "specialite" => "nullable", 
                "annee_doctorat"=> "nullable",
        ];
    }
}
