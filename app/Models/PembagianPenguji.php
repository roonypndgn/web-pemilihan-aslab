<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembagianPenguji extends Model
{
    use HasFactory;

    protected $table = 'pembagian_pengujis';

    protected $fillable = [
        'pendaftaran_id',
        'penguji_id'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranAslab::class);
    }

    public function penguji()
    {
        return $this->belongsTo(User::class, 'penguji_id');
    }
}