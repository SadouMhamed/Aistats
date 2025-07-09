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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nom',
        'prenom',
        'profession',
        'telephone',
        'email',
        'password',
        'role',
        'pack',
        'meeting_preference',
        'payment_preference',
        'payment_status',
        'devis_services',
        'devis_nb_individus',
        'devis_nb_variables',
        'devis_delais',
        'devis_remarques',
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
            'devis_services' => 'array',
        ];
    }

    /**
     * Check if user has admin role
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user has specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get the files uploaded by the user
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * Get files sent by this user (if admin) to other users
     */
    public function sentFiles()
    {
        return $this->hasMany(AdminUserFile::class, 'admin_id');
    }

    /**
     * Get devis for this user
     */
    public function devis()
    {
        return $this->hasMany(Devis::class);
    }

    /**
     * Get factures for this user
     */
    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    /**
     * Get devis created by this admin
     */
    public function devisCreated()
    {
        return $this->hasMany(Devis::class, 'admin_id');
    }

    /**
     * Get factures created by this admin
     */
    public function facturesCreated()
    {
        return $this->hasMany(Facture::class, 'admin_id');
    }

    /**
     * Check if user has services à la carte data
     */
    public function hasServicesCarteDemande(): bool
    {
        return !empty($this->devis_services);
    }

    /**
     * Get files received by this user from admin
     */
    public function receivedFiles()
    {
        return $this->hasMany(AdminUserFile::class, 'user_id');
    }
}
