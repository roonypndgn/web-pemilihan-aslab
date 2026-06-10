<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSeleksi extends Model
{
    use HasFactory;

    protected $table = 'hasil_seleksis';

    protected $fillable = [
        'pendaftaran_id',
        'skor_akhir',
        'ranking',
        'status_kelulusan'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranAslab::class);
    }
}