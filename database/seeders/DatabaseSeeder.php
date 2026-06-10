<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\KriteriaPenilaian;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Kepala Lab
        User::create([
            'nama' => 'Kepala Laboratorium Software',
            'email' => 'kepalalab@methodist.ac.id',
            'password' => Hash::make('password'),
            'role' => 'kepala_lab',
            'status' => true
        ]);

        // Create Penguji
        $penguji = [
            ['nama' => 'Penguji 1', 'email' => 'penguji1@methodist.ac.id'],
            ['nama' => 'Penguji 2', 'email' => 'penguji2@methodist.ac.id'],
            ['nama' => 'Penguji 3', 'email' => 'penguji3@methodist.ac.id'],
        ];

        foreach ($penguji as $p) {
            User::create([
                'nama' => $p['nama'],
                'email' => $p['email'],
                'password' => Hash::make('password'),
                'role' => 'penguji',
                'status' => true
            ]);
        }

        // Create Kriteria Penilaian
        $kriteria = [
            ['kode' => 'K1', 'nama_kriteria' => 'Penguasaan Materi', 'jenis' => 'benefit'],
            ['kode' => 'K2', 'nama_kriteria' => 'Live Coding', 'jenis' => 'benefit'],
            ['kode' => 'K3', 'nama_kriteria' => 'Wawancara', 'jenis' => 'benefit'],
            ['kode' => 'K4', 'nama_kriteria' => 'Komunikasi', 'jenis' => 'benefit'],
            ['kode' => 'K5', 'nama_kriteria' => 'Kepercayaan Diri', 'jenis' => 'benefit'],
        ];

        foreach ($kriteria as $k) {
            KriteriaPenilaian::create($k);
        }

        // Create Mata Kuliah
        $mataKuliah = [
            ['kode_mk' => 'IF301', 'nama_mk' => 'Praktikum Basis Data', 'semester' => 5],
            ['kode_mk' => 'IF302', 'nama_mk' => 'Praktikum Pemrograman Web', 'semester' => 5],
            ['kode_mk' => 'IF303', 'nama_mk' => 'Praktikum Pemrograman Visual', 'semester' => 6],
        ];

        foreach ($mataKuliah as $mk) {
            MataKuliah::create($mk);
        }
    }
}