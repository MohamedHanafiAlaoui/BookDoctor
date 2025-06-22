<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_user'; // Puisque ta clé primaire est id_user
    public $incrementing = false; // Car id_user est aussi une foreign key et non auto-incrémentée
    protected $keyType = 'unsignedBigInteger'; // Type de la clé primaire

    protected $fillable = [
        'id_user',
        'medical_history',
        'groupe_sanguin',
        'allergies',
        'adresse',
        'code_postal',
        'ville',
        'image',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
