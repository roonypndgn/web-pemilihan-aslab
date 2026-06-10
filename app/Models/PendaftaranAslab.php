<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAslab extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_aslabs';

    protected $fillable = [
        'user_id',
        'periode_id',
        'ipk',
        'semester_sekarang',
        'status_administrasi',
        'catatan'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeSeleksi::class, 'periode_id');
    }

    public function pilihanMataKuliah()
    {
        return $this->hasMany(PilihanMataKuliah::class);
    }

    public function berkasPendaftaran()
    {
        return $this->hasMany(BerkasPendaftaran::class);
    }

    public function pembagianPenguji()
    {
        return $this->hasMany(PembagianPenguji::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasilSeleksi()
    {
        return $this->hasOne(HasilSeleksi::class);
    }

    public function cekKelulusanAdministrasi()
    {
        if ($this->ipk < 3.50) {
            return false;
        }

        foreach ($this->pilihanMataKuliah as $pilihan) {
            $nilaiOrder = ['E', 'D', 'C', 'B', 'B+', 'A-', 'A'];
            $nilaiIndex = array_search($pilihan->nilai_mata_kuliah, $nilaiOrder);
            $bPlusIndex = array_search('B+', $nilaiOrder);
            
            if ($nilaiIndex < $bPlusIndex) {
                return false;
            }
        }

        return true;
    }

    public function updateStatusAdministrasi()
    {
        $this->status_administrasi = $this->cekKelulusanAdministrasi() ? 'lolos' : 'ditolak';
        $this->save();
        
        return $this;
    }
}