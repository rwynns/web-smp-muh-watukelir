<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    /**
     * Tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'berita';

    /**
     * Atribut yang dapat diisi (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'published_at',
    ];

    /**
     * Atribut yang harus dikonversi ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Konstanta untuk kategori berita
     */
    const CATEGORY_BERITA = 'berita_sekolah';
    const CATEGORY_PENGUMUMAN = 'pengumuman';
    const CATEGORY_AGENDA = 'agenda';
    const CATEGORY_KALENDER = 'kalender_akademik';

    /**
     * Mendapatkan array pilihan kategori berita.
     */
    public static function categoryOptions(): array
    {
        return [
            self::CATEGORY_BERITA => 'Berita Sekolah',
            self::CATEGORY_PENGUMUMAN => 'Pengumuman',
            self::CATEGORY_AGENDA => 'Agenda',
            self::CATEGORY_KALENDER => 'Kalender Akademik',
        ];
    }

    /**
     * Hubungan ke user (penulis berita).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Membuat slug otomatis dari judul jika belum ada.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->title);
            }
        });
    }

    /**
     * Mendapatkan nama kategori dalam format yang lebih manusiawi.
     */
    public function getCategoryNameAttribute()
    {
        return self::categoryOptions()[$this->category] ?? $this->category;
    }

    /**
     * Format tanggal publikasi untuk tampilan.
     */
    public function getFormattedPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d F Y') : '-';
    }

    /**
     * Mendapatkan URL gambar lengkap.
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('img/noimage.jpg'); // Default image
        }

        // Jika sudah URL lengkap, kembalikan apa adanya
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Jika path relatif, tambahkan base URL
        return asset('storage/' . $this->image);
    }

    /**
     * Format ringkasan jika tidak ada.
     */
    public function getExcerptOrGenerateAttribute()
    {
        if (!empty($this->excerpt)) {
            return $this->excerpt;
        }

        // Generate excerpt dari content
        return Str::limit(strip_tags($this->content), 200);
    }

    /**
     * Scope untuk berita yang sudah dipublikasikan.
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope untuk berita berdasarkan kategori.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope untuk berita terbaru.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Scope untuk pencarian berita.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%");
        });
    }

    /**
     * Cek apakah berita sudah dipublikasikan.
     */
    public function isPublished()
    {
        return !is_null($this->published_at) && $this->published_at->lte(now());
    }

    /**
     * Publish berita.
     */
    public function publish($date = null)
    {
        $this->published_at = $date ?? now();
        $this->save();

        return $this;
    }

    /**
     * Unpublish berita.
     */
    public function unpublish()
    {
        $this->published_at = null;
        $this->save();

        return $this;
    }
}
