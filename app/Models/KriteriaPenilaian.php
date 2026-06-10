<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPenilaian extends Model
{
    use HasFactory;

    protected $table = 'kriteria_penilaians';

    protected $fillable = [
        'kode',
        'nama_kriteria',
        'jenis'
    ];

    public function perbandinganSebagaiKriteria1()
    {
        return $this->hasMany(AhpPerbandingan::class, 'kriteria_1_id');
    }

    public function perbandinganSebagaiKriteria2()
    {
        return $this->hasMany(AhpPerbandingan::class, 'kriteria_2_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}