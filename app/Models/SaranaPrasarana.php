<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SaranaPrasarana extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'sarana_prasarana';

    /**
     * Atribut yang dapat diisi.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'gambar_path',
        'deskripsi',
    ];

    /**
     * Mendapatkan URL untuk file gambar.
     *
     * @return string
     */
    public function getGambarUrlAttribute()
    {
        return asset('storage/' . $this->gambar_path);
    }

    /**
     * Mendapatkan ekstensi file gambar.
     *
     * @return string
     */
    public function getGambarExtensionAttribute()
    {
        return pathinfo($this->gambar_path, PATHINFO_EXTENSION);
    }

    /**
     * Cek apakah file gambar tersedia.
     *
     * @return bool
     */
    public function getFileExistsAttribute()
    {
        return Storage::disk('public')->exists($this->gambar_path);
    }

    /**
     * Mendapatkan ringkasan deskripsi.
     *
     * @param int $length
     * @return string
     */
    public function getDeskripsiRingkasAttribute($length = 100)
    {
        return strlen($this->deskripsi) > $length
            ? substr($this->deskripsi, 0, $length) . '...'
            : $this->deskripsi;
    }
}
