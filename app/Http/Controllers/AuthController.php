<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function showRegisterForm()
    {
        return view('inscription');
    }


    public function showloginForm()
    {
        return view('login');
    }
    public function register(RegisterRequest $request)
    {
        // dd($request);
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'number_phone' => $request->number_phone,
            'password' => Hash::make($request->password),
            'id_role' => $request->id_role,
        ]);

        switch ($user->id_role) {
            case 2: // Médecin
                Medecin::create([
                    'id' => $user->id,
                    'license_number' => '',
                    'years_of_experience' => 0,
                    'image' => 'default.jpg',
                    'adresse' => '',
                    'description' => ''
                ]);
                break;
            case 3: // Patient
                Patient::create([
                    'id_user' => $user->id,
                    'medical_history' => '',
                    'image' => 'default.jpg'
                ]);
                break;
        }


        return response()->json([
            'message' => 'Utilisateur créé avec succès.',
            'user' => $user
        ], 201);
    }


    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->identifier)
            ->orWhere('number_phone', $request->identifier)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Identifiants incorrects.'
            ], 401);
        }

        $roleData = null;
        switch ($user->id_role) {
            case 2: // Médecin
                $roleData = Medecin::where('id', $user->id)->first();
                break;
            case 3: // Patient
                $roleData = Patient::where('id_user', $user->id)->first();
                break;
        }

        return response()->json([
            'message' => 'Connexion réussie.',
            'user' => $user,
            'role_data' => $roleData,
        ]);
    }

}
