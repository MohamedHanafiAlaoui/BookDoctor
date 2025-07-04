<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Autoriser tous les utilisateurs à faire la requête
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s\-]+$/u' // Lettres, espaces, tirets
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'number_phone' => [
                'required',
                // Validation pour numéro international avec espaces, tirets, points, parenthèses
                'regex:/^\+?\d{1,3}[\s\-\.]?\(?\d{1,4}\)?[\s\-\.]?\d{1,4}[\s\-\.]?\d{1,4}[\s\-\.]?\d{0,4}$/',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
            'id_role' => [
                'required',
                'in:2,3' // Médecin=2, Patient=3
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Le nom complet est obligatoire.',
            'full_name.regex' => 'Le nom ne doit contenir que des lettres, espaces ou tirets.',
            
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email est invalide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            
            'number_phone.required' => 'Le numéro de téléphone est obligatoire.',
            'number_phone.regex' => 'Le numéro de téléphone est invalide. Exemple valide: +1 (209) 651-9573, +212 612-345-678, 0612345678',
            
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.regex' => 'Le mot de passe doit contenir une majuscule, une minuscule, un chiffre et un symbole.',
            
            'id_role.required' => 'Le rôle est obligatoire.',
            'id_role.in' => 'Le rôle sélectionné est invalide.',
        ];
    }
}
