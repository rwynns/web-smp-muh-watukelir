<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PPDB extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'ppdb';

    /**
     * Atribut yang dapat diisi.
     *
     * @var array
     */
    protected $fillable = [
        'nama_lengkap',
        'formulir_path',
    ];

    /**
     * Mendapatkan URL untuk file formulir.
     *
     * @return string
     */
    public function getFormulirUrlAttribute()
    {
        return Storage::url($this->formulir_path);
    }
}
