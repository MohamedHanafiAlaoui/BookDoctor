<?php
namespace App\Services;

use App\Models\RendezVous;
use App\Models\Calendrier;

class RendezVousService
{
    public function create(array $data)
    {
        $exists = Calendrier::where('medecin_id', $data['medecin_id'])
            ->where('jour', $data['date_rendez_vous'])
            ->whereTime('heure_debut', '<=', $data['heure'])
            ->whereTime('heure_fin', '>=', $data['heure'])
            ->exists();

        if (! $exists) {
            throw new \Exception("Le médecin n'est pas disponible à cette heure.");
        }

        return RendezVous::create($data);
    }

    public function update(RendezVous $rdv, array $data)
    {
        $rdv->update($data);
        return $rdv;
    }

    public function delete(RendezVous $rdv)
    {
        return $rdv->delete();
    }

    public function listByUser($user)
    {
        if ($user->usertype == 'medecin') {
            return RendezVous::where('medecin_id', $user->id)->get();
        } elseif ($user->usertype == 'patient') {
            return RendezVous::where('patient_id', $user->id)->get();
        }
    }
}
