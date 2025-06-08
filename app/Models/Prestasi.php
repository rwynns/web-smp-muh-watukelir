<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image'
    ];

    /**
     * Boot method untuk auto-generate slug dan excerpt
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($prestasi) {
            // Auto-generate slug jika kosong
            if (empty($prestasi->slug)) {
                $prestasi->slug = Str::slug($prestasi->title);

                // Pastikan slug unik
                $originalSlug = $prestasi->slug;
                $counter = 1;
                while (static::where('slug', $prestasi->slug)->exists()) {
                    $prestasi->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }

            // Auto-generate excerpt jika kosong
            if (empty($prestasi->excerpt)) {
                $prestasi->excerpt = Str::limit(strip_tags($prestasi->content), 200);
            }
        });

        static::updating(function ($prestasi) {
            // Update slug jika title berubah
            if ($prestasi->isDirty('title')) {
                $baseSlug = Str::slug($prestasi->title);
                $originalSlug = $baseSlug;
                $counter = 1;

                // Pastikan slug unik kecuali untuk record yang sedang diupdate
                while (static::where('slug', $baseSlug)->where('id', '!=', $prestasi->id)->exists()) {
                    $baseSlug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $prestasi->slug = $baseSlug;
            }

            // Update excerpt jika content berubah dan excerpt kosong
            if ($prestasi->isDirty('content') && empty($prestasi->excerpt)) {
                $prestasi->excerpt = Str::limit(strip_tags($prestasi->content), 200);
            }
        });
    }

    /**
     * Relasi dengan User (Admin yang membuat)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk URL detail prestasi
     */
    public function getUrlAttribute()
    {
        return route('prestasi.show', $this->slug);
    }

    /**
     * Mutator untuk title (proper case)
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords(strtolower($value));
    }

    /**
     * Scope untuk prestasi terbaru
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
                ->orWhere('content', 'LIKE', "%{$search}%")
                ->orWhere('excerpt', 'LIKE', "%{$search}%");
        });
    }

    /**
     * Method untuk mendapatkan prestasi terkait
     */
    public function getRelatedPrestasi($limit = 4)
    {
        return static::where('id', '!=', $this->id)
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Method untuk format tanggal yang user-friendly
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    /**
     * Method untuk mendapatkan excerpt dengan panjang custom
     */
    public function getCustomExcerpt($length = 150)
    {
        if ($this->excerpt) {
            return Str::limit($this->excerpt, $length);
        }

        return Str::limit(strip_tags($this->content), $length);
    }

    /**
     * Accessor untuk mendapatkan path image
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }

        return null;
    }

    /**
     * Method untuk check apakah prestasi memiliki gambar
     */
    public function hasImage()
    {
        return !empty($this->image) && Storage::exists($this->image);
    }

    /**
     * Method untuk mendapatkan reading time estimate
     */
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / 200); // Asumsi 200 kata per menit

        return $minutes . ' menit';
    }

    /**
     * Method untuk mendapatkan path thumbnail jika ada
     */
    public function getThumbnailAttribute()
    {
        if ($this->hasImage()) {
            return $this->image_url;
        }

        // Return default thumbnail jika tidak ada gambar
        return asset('images/default-prestasi.jpg');
    }
}
