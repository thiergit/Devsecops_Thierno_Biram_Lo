<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePatient extends FormRequest
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
            'nom'=>'required',
            "prenom" => "required",
            "dateNaiss" => "required",
            "lieuNaiss" => "required",
            "tel" => "required",
            "sexe" => "nullable",
            "adresse" => "nullable", 
            "telUrgent"=> "nullable",
            "codePostale"=> "nullable",
        ];
    }
}
