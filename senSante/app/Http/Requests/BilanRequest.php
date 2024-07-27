<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BilanRequest extends FormRequest
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
            "abdo" => 'required|in:oui,non', 
            "nause" => 'required|in:oui,non',
            "fatigue" => 'required|in:oui,non', 
            "fievre" => 'required|in:oui,non', 
            "jaune" => 'required|in:oui,non', 
            "articulation" => 'required|in:oui,non', 
            "urine" => 'required|in:oui,non',
            "selle" => 'required|in:oui,non',
            "appetit" => 'required|in:oui,non', 
            "tete" => 'required|in:oui,non',
        ];
    }
    
}
