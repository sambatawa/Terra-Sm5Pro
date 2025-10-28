<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_user',
        'nama',
        'email',
        'password',
        'role',
        'alamat',
        'no_hp',
        'foto',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'id_user', 'id_user');
    }
}
