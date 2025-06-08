<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::with('user');

        // Filter berdasarkan kategori jika ada
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        // Pencarian berdasarkan judul atau konten
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Pengurutan
        $sortField = $request->sort_by ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'desc';
        $query->orderBy($sortField, $sortOrder);

        $berita = $query->paginate(10);

        return view('admin.berita.index', [
            'berita' => $berita,
            'categories' => Berita::categoryOptions(),
            'filters' => $request->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create', [
            'categories' => Berita::categoryOptions()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:' . implode(',', array_keys(Berita::categoryOptions())),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Maksimal 5MB
            'excerpt' => 'nullable|max:500',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generate slug dari judul
        $slug = Str::slug($request->title);
        $originalSlug = $slug;

        // Pastikan slug unik
        $count = 1;
        while (Berita::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('berita', $imageName, 'public');
        }

        // Selalu generate excerpt dari konten (hapus pengkondisian)
        $plainContent = strip_tags($request->content);
        $excerpt = Str::limit($plainContent, 200);

        // Buat berita baru
        $berita = new Berita();
        $berita->user_id = Auth::id();
        $berita->title = $request->title;
        $berita->slug = $slug;
        $berita->content = $request->content;
        $berita->excerpt = $excerpt; // Selalu gunakan auto-generate excerpt
        $berita->category = $request->category;
        $berita->image = $imagePath;

        // Atur tanggal publikasi
        if ($request->has('is_published') && $request->is_published) {
            $berita->published_at = $request->published_at ?? now();
        }

        try {
            $berita->save();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan berita: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        return view('admin.berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', [
            'berita' => $berita,
            'categories' => Berita::categoryOptions()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:' . implode(',', array_keys(Berita::categoryOptions())),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'nullable|max:500',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Jika judul berubah, generate slug baru
        if ($request->title != $berita->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;

            // Pastikan slug unik
            $count = 1;
            while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $berita->slug = $slug;
        }

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($berita->image && Storage::disk('public')->exists($berita->image)) {
                Storage::disk('public')->delete($berita->image);
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('berita', $imageName, 'public');

            $berita->image = $imagePath;
        }

        // Selalu generate excerpt dari konten (hapus pengkondisian)
        $plainContent = strip_tags($request->content);
        $excerpt = Str::limit($plainContent, 200);

        // Update berita
        $berita->title = $request->title;
        $berita->content = $request->content;
        $berita->excerpt = $excerpt; // Selalu gunakan auto-generate excerpt
        $berita->category = $request->category;

        // Atur tanggal publikasi
        if ($request->has('is_published')) {
            if ($request->is_published) {
                $berita->published_at = $request->published_at ?? now();
            } else {
                $berita->published_at = null;
            }
        }

        $berita->save();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        // Hapus gambar jika ada
        if ($berita->image && Storage::disk('public')->exists($berita->image)) {
            Storage::disk('public')->delete($berita->image);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    public function publicIndex(Request $request, $category = null)
    {
        $categories = [
            'berita_sekolah' => 'Berita Sekolah',
            'pengumuman' => 'Pengumuman',
            'agenda' => 'Agenda',
            'prestasi' => 'Prestasi'
        ];

        $query = Berita::query();

        // Filter berdasarkan kategori dari parameter URL
        if ($category && array_key_exists($category, $categories)) {
            $query->where('category', $category);
        }
        // Filter berdasarkan kategori dari query string
        elseif ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        $beritas = $query->orderBy('created_at', 'desc')->paginate(9);

        // Tentukan judul halaman berdasarkan kategori
        $pageTitle = $category && isset($categories[$category])
            ? $categories[$category]
            : 'Semua Berita';

        return view('berita_sekolah', compact('beritas', 'categories', 'category', 'pageTitle'));
    }

    /**
     * Display the specified public resource.
     */
    public function publicShow($category, $slug)
    {
        // Validasi kategori
        $validCategories = ['berita_sekolah', 'pengumuman', 'agenda', 'prestasi'];

        if (!in_array($category, $validCategories)) {
            abort(404);
        }

        // Cari berita berdasarkan slug dan kategori
        $berita = Berita::where('slug', $slug)
            ->where('category', $category)
            ->firstOrFail();

        // Get related news (same category, excluding current article)
        $relatedNews = Berita::where('category', $berita->category)
            ->where('id', '!=', $berita->id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('berita_sekolah_detail', compact('berita', 'relatedNews'));
    }
}
