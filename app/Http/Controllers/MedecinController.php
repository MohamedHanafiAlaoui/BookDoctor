<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use App\Services\ProfilService;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    protected $profilService;

    public function __construct(ProfilService $profilService)
    {
        $this->profilService = $profilService;
    }

    public function profileMedecin()
    {
        $user = $this->profilService->getProfileMedecin();
        return view('medecin.profil.index', compact('user'));
    }



    public function edit()
    {
        $user = $this->profilService->getProfileMedecin(); 
        $specialites = Specialite::all();


        return view('medecin.profil.edit', compact('user', 'specialites'));
    }
    public function update(Request $request)
{
    // dd($request);
 $request->validate([
    'full_name'            => 'required|string|max:255',
    'email'                => 'required|email|max:255',
    'number_phone'         => 'required|string|max:20',
    'license_number'       => 'required|string|max:50',
    'specialite_id'        => 'required|exists:specialite,id',
    'adresse'              => 'required|string|max:255',
    'years_of_experience'  => 'required|integer|min:0|max:60',
    'description'          => 'nullable|string|max:2000', // optionnel
]);


    $this->profilService->updateProfileMedecin($request);

    return redirect()->route('medecin.profil.index')
        ->with('success', 'Profil mis à jour avec succès');
}


}
