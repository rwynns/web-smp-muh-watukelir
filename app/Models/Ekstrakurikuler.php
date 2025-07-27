<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'ekstrakurikuler';

    /**
     * Atribut yang dapat diisi.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'gambar_path',
        'logo_path',
        'deskripsi',
    ];

    /**
     * Mendapatkan URL untuk file gambar.
     *
     * @return string|null
     */
    public function getGambarUrlAttribute()
    {
        return $this->gambar_path ? asset('storage/' . $this->gambar_path) : null;
    }

    /**
     * Mendapatkan URL untuk file logo.
     *
     * @return string|null
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : null;
    }

    /**
     * Mendapatkan ekstensi file gambar.
     *
     * @return string|null
     */
    public function getGambarExtensionAttribute()
    {
        return $this->gambar_path ? pathinfo($this->gambar_path, PATHINFO_EXTENSION) : null;
    }

    /**
     * Mendapatkan ekstensi file logo.
     *
     * @return string|null
     */
    public function getLogoExtensionAttribute()
    {
        return $this->logo_path ? pathinfo($this->logo_path, PATHINFO_EXTENSION) : null;
    }

    /**
     * Cek apakah file gambar tersedia.
     *
     * @return bool
     */
    public function getGambarFileExistsAttribute()
    {
        return $this->gambar_path && Storage::disk('public')->exists($this->gambar_path);
    }

    /**
     * Cek apakah file logo tersedia.
     *
     * @return bool
     */
    public function getLogoFileExistsAttribute()
    {
        return $this->logo_path && Storage::disk('public')->exists($this->logo_path);
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
