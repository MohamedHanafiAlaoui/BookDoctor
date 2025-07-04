<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'medecin_id',
        'jour',
        'heure_debut',
        'heure_fin'
    ];

    public function medecin()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
}
