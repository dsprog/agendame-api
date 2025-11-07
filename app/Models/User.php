<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'first_name' => 'string',
            'last_name' => 'string',
        ];
    }

    /**
     * Get the user's first name.
     */
    public function getFirstNameAttribute(): string
    {
        $parts = explode(' ', $this->name);
        return $parts[0] ?? '';
    }

    /**
     * Get the user's last name.
     */
    public function getLastNameAttribute(): string
    {
        $parts = explode(' ', $this->name);
        if(count($parts) < 2) {
            return '';
        }
        return end($parts);
    }
}
