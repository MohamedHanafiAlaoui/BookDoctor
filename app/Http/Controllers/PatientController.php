<?php

namespace App\Http\Controllers;

use App\Services\ProfilService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $profilService;

    public function __construct(ProfilService $profilService)
    {
        $this->profilService = $profilService;
    }

    public function profilePatient()
    {
       
        $user = $this->profilService->getProfilePatient();
        
        return view('patients.profil.index', compact('user'));
    }




    public function update(Request $request)
    {
        $request->validate([
            'full_name'        => 'required|string|max:255',
            'email'            => 'required|email',
            'number_phone'     => 'required|string|max:20',
            'medical_history'  => 'nullable|string',
            'groupe_sanguin'   => 'nullable|string|max:10',
            'allergies'        => 'nullable|string|max:255',
            'adresse'          => 'nullable|string|max:255',
            'ville'            => 'nullable|string|max:100',
            'code_postal'      => 'nullable|string|max:10',
        ]);

        $this->profilService->updateProfilePatient($request);

        return redirect()->route('patients.profil.index')
            ->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

}
