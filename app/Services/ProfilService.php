<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfilService
{
    public function getProfilePatient()
    {

        return User::with('patient')->findOrFail(auth()->id());
    }


    public function updateProfilePatient($request)
    {
        $user = User::with('patient')->findOrFail(auth()->id());

        $user->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'number_phone' => $request->number_phone,
        ]);

        // Mettre à jour les informations spécifiques au patient
        $user->patient->update([
            'groupe_sanguin' => $request->groupe_sanguin,
            'adresse' => $request->adresse,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'allergies' => $request->allergies,
            'medical_history' => $request->medical_history,
        ]);
    }



    public function getProfileMedecin()
    {
        return User::with(relations: ['medecin.specialite'])->findOrFail(auth()->id());
    }


    public function updateProfileMedecin($request)
{
    $user = User::with('medecin')->findOrFail(auth()->id());

    $user->update([
        'full_name'    => $request->full_name,
        'email'        => $request->email,
        'number_phone' => $request->number_phone,
    ]);

    $user->medecin->update([
        'license_number' => $request->license_number,
        'specialite_id'  => $request->specialite_id,
        'adresse'        => $request->adresse,
        'years_of_experience'    => $request->years_of_experience,
        'description'    => $request->description,
    ]);
}

}