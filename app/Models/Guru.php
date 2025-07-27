<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto'
    ];

    protected $casts = [
        'jabatan' => 'array', // Cast JSON ke array
    ];

    // Accessor untuk URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }
        return asset('img/fotokosong.jpg'); // Default foto kosong
    }

    // Accessor untuk check apakah foto ada
    public function getFotoExistsAttribute()
    {
        return $this->foto && Storage::disk('public')->exists($this->foto);
    }

    // Accessor untuk mendapatkan jabatan sebagai string
    public function getJabatanStringAttribute()
    {
        if (is_array($this->jabatan)) {
            return implode(', ', $this->jabatan);
        }
        return $this->jabatan;
    }
}
