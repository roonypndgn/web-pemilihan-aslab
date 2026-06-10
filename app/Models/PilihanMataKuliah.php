<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanMataKuliah extends Model
{
    use HasFactory;

    protected $table = 'pilihan_mata_kuliahs';

    protected $fillable = [
        'pendaftaran_id',
        'mata_kuliah_id',
        'nilai_mata_kuliah'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranAslab::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}