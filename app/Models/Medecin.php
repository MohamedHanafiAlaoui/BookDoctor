<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Puisque tu as utilisé id (foreign key liée à users)
    public $incrementing = false;
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'id',
        'license_number',
        'years_of_experience',
        'image',
        'adresse',
        'description',
        'specialite_id',
    ];

    // Relation avec l'utilisateur (user)
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relation avec la spécialité
    public function specialite()
    {
        return $this->belongsTo(Specialite::class, 'specialite_id');
    }
}
