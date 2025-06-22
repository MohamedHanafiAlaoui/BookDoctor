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


        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Veuillez vous connecter.');

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
            return back()->withErrors(['identifier' => 'Identifiants incorrects.']);
        }

        auth()->login($user);

        // Redirection selon le rôle
    return redirect()->route('dashboard.redirect');

    }



        public function redirectBasedOnRole()
    {
        $user = auth()->user();

        switch ($user->id_role) {
            case 1:
                return redirect()->route('admin.dashboard');
            case 2:
                return redirect()->route('medecin.profil.index');
            case 3:
                return redirect()->route('patients.profil.index');
            default:
                abort(404); // أو return view('errors.404');
        }
    }


}
