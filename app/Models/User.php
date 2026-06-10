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
        'status'
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

    // Relationships
    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranAslab::class, 'user_id');
    }

    public function pembagianPenguji()
    {
        return $this->hasMany(PembagianPenguji::class, 'penguji_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'penguji_id');
    }

    public function logs()
    {
        return $this->hasMany(LogAktivitas::class);
    }

    public function isKepalaLab()
    {
        return $this->role === 'kepala_lab';
    }

    public function isPenguji()
    {
        return $this->role === 'penguji';
    }

    public function isCalonAslab()
    {
        return $this->role === 'calon_aslab';
    }
}