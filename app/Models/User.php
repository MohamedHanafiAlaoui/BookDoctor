<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'email',
        'number_phone',
        'statut',
        'password',
        'id_role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'statut' => 'string',
    ];

    // === العلاقات ===

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class,'id_user');
    }

    public function medecin()
    {
        return $this->hasOne(Medecin::class,'id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    // public function messagesSent()
    // {
    //     return $this->hasMany(Message::class, 'sender_id');
    // }

    // public function messagesReceived()
    // {
    //     return $this->hasMany(Message::class, 'receiver_id');
    // }
}
