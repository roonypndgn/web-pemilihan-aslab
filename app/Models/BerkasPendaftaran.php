<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'berkas_pendaftarans';

    protected $fillable = [
        'pendaftaran_id',
        'jenis_berkas',
        'nama_file',
        'path_file'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranAslab::class);
    }
}