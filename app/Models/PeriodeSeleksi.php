<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeSeleksi extends Model
{
    use HasFactory;

    protected $table = 'periode_seleksis';

    protected $fillable = [
        'nama_periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranAslab::class);
    }

    public function isOpen()
    {
        return $this->status === 'dibuka';
    }

    public function isActive()
    {
        $now = now();
        return $this->status === 'dibuka' && 
               $now->between($this->tanggal_mulai, $this->tanggal_selesai);
    }
}