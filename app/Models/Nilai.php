<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'user_id',
        'mata_kuliah_id',
        'tugas',
        'uts',
        'uas'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function nilaiAkhir()
    {
        return ($this->tugas * 0.3) +
            ($this->uts * 0.3) +
            ($this->uas * 0.4);
    }

    public function bobot()
    {
        $nilai = $this->nilaiAkhir();

        if ($nilai >= 85) return 4;
        if ($nilai >= 75) return 3;
        if ($nilai >= 65) return 2;
        if ($nilai >= 50) return 1;

        return 0;
    }
}