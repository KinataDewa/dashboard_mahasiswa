<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Nilai;
use App\Models\Absensi;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // USER
        $user1 = User::create([
            'name' => 'Kinata Dewa',
            'email' => 'kinata@mail.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => '224122',
            'kelas' => 'TI 4C',
        ]);

        $user2 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@mail.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => '224123',
            'kelas' => 'TI 4B',
        ]);

        // MATA KULIAH
        $mk1 = MataKuliah::create([
            'nama' => 'Basis Data',
            'kode' => 'BD01'
        ]);

        $mk2 = MataKuliah::create([
            'nama' => 'Pemrograman Web',
            'kode' => 'PW01'
        ]);

        $mk3 = MataKuliah::create([
            'nama' => 'Jaringan Komputer',
            'kode' => 'JK01'
        ]);

        // NILAI
        Nilai::create([
            'user_id' => $user1->id,
            'mata_kuliah_id' => $mk1->id,
            'tugas' => 85,
            'uts' => 80,
            'uas' => 90,
        ]);

        Nilai::create([
            'user_id' => $user1->id,
            'mata_kuliah_id' => $mk2->id,
            'tugas' => 88,
            'uts' => 84,
            'uas' => 87,
        ]);

        Nilai::create([
            'user_id' => $user2->id,
            'mata_kuliah_id' => $mk3->id,
            'tugas' => 70,
            'uts' => 75,
            'uas' => 78,
        ]);

        // ABSENSI
        for ($i = 1; $i <= 6; $i++) {
            Absensi::create([
                'user_id' => $user1->id,
                'mata_kuliah_id' => $mk1->id,
                'tanggal' => now()->toDateString(),
                'jam_ke' => $i,
                'status' => $i == 3 ? 'alpha' : 'hadir',
            ]);
        }

        for ($i = 1; $i <= 4; $i++) {
            Absensi::create([
                'user_id' => $user2->id,
                'mata_kuliah_id' => $mk3->id,
                'tanggal' => now()->toDateString(),
                'jam_ke' => $i,
                'status' => 'hadir',
            ]);
        }
    }
}