<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'npm',
        'email',
        'password',
        'foto',
        'jenis_kelamin',
        'nomor_hp',
        'angkatan',
        'program_studi',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'boolean',
    ];

    public function isKepalaLab(): bool
    {
        return $this->role === 'kepala_lab';
    }

    public function isPenguji(): bool
    {
        return $this->role === 'penguji';
    }

    public function isCalonAslab(): bool
    {
        return $this->role === 'calon_aslab';
    }

    public function getDashboardRoute(): string
    {
        return match($this->role) {
            'kepala_lab' => route('kepalalab.dashboard'),
            'penguji' => route('penguji.dashboard'),
            'calon_aslab' => route('calonaslab.dashboard'),
            default => route('login'),
        };
    }

    public function getRoleLabel(): string
    {
        return match($this->role) {
            'kepala_lab' => 'Kepala Laboratorium',
            'penguji' => 'Tim Penguji',
            'calon_aslab' => 'Calon Asisten Laboratorium',
            default => 'Unknown',
        };
    }


    public function getRoleIcon(): string
    {
        return match($this->role) {
            'kepala_lab' => 'fas fa-user-tie',
            'penguji' => 'fas fa-user-check',
            'calon_aslab' => 'fas fa-user-graduate',
            default => 'fas fa-user',
        };
    }

    public function isActive(): bool
    {
        return $this->status === true;
    }

    public function pendaftaran()
    {
        return $this->hasOne(PendaftaranAslab::class, 'user_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'penguji_id');
    }

    public function pembagianPenguji()
    {
        return $this->hasMany(PembagianPenguji::class, 'penguji_id');
    }

    public function logs()
    {
        return $this->hasMany(LogAktivitas::class);
    }
}