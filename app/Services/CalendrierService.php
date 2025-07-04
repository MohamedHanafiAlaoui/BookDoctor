<?php
namespace App\Services;

use App\Models\Calendrier;
use Illuminate\Support\Facades\Auth;

class CalendrierService
{
    /**
     * Créer un nouveau calendrier pour le médecin connecté.
     */
    public function createCalendrier(array $data): Calendrier
    {
        return Calendrier::create([
            'medecin_id' => Auth::id(),
            'jour' => $data['jour'],
            'heure_debut' => $data['heure_debut'],
            'heure_fin' => $data['heure_fin'],
        ]);
    }
}
