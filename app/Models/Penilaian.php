<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaians';

    protected $fillable = [
        'pendaftaran_id',
        'penguji_id',
        'kriteria_id',
        'nilai'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranAslab::class);
    }

    public function penguji()
    {
        return $this->belongsTo(User::class, 'penguji_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(KriteriaPenilaian::class);
    }
}