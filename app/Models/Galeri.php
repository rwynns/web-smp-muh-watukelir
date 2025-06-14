<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'galeri';

    /**
     * Atribut yang dapat diisi.
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'file_path',
    ];

    /**
     * Mendapatkan URL untuk file gambar.
     *
     * @return string
     */
    public function getGambarUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Mendapatkan nama file gambar saja.
     *
     * @return string
     */
    public function getFilenameAttribute()
    {
        return basename($this->file_path);
    }

    /**
     * Cek apakah file gambar tersedia.
     *
     * @return bool
     */
    public function getFileExistsAttribute()
    {
        return Storage::disk('public')->exists($this->file_path);
    }
}
