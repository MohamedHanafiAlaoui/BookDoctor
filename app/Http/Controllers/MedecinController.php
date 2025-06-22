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
    $request->validate([
        'full_name'       => 'required|string|max:255',
        'email'           => 'required|email',
        'number_phone'    => 'required|string|max:20',
        'license_number'  => 'nullable|string|max:50',
        'specialite_id'   => 'nullable|exists:specialite,id',
        'adresse'         => 'nullable|string|max:255',
        'ville'           => 'nullable|string|max:100',
        'code_postal'     => 'nullable|string|max:10',
    ]);

    $this->profilService->updateProfileMedecin($request);

    return redirect()->route('medecin.profil.index')
        ->with('success', 'تم تحديث الملف الشخصي للطبيب بنجاح');
}


}
