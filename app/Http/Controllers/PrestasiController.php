<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prestasi::with('user');

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

        $prestasi = $query->paginate(10);

        return view('admin.prestasi.index', [
            'prestasi' => $prestasi,
            'filters' => $request->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Maksimal 5MB
            'excerpt' => 'nullable|max:500',
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
        while (Prestasi::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Upload gambar utama jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('prestasi', $imageName, 'public');
        }

        // Generate excerpt dari konten
        $plainContent = strip_tags($request->content);
        $excerpt = Str::limit($plainContent, 200);

        // Buat prestasi baru
        $prestasi = new Prestasi();
        $prestasi->user_id = Auth::id();
        $prestasi->title = $request->title;
        $prestasi->slug = $slug;
        $prestasi->content = $request->content;
        $prestasi->excerpt = $excerpt;
        $prestasi->image = $imagePath;

        try {
            $prestasi->save();

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Prestasi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan prestasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        return view('admin.prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'excerpt' => 'nullable|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Jika judul berubah, generate slug baru
        if ($request->title != $prestasi->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;

            // Pastikan slug unik
            $count = 1;
            while (Prestasi::where('slug', $slug)->where('id', '!=', $prestasi->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $prestasi->slug = $slug;
        }

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($prestasi->image && Storage::disk('public')->exists($prestasi->image)) {
                Storage::disk('public')->delete($prestasi->image);
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('prestasi', $imageName, 'public');

            $prestasi->image = $imagePath;
        }

        // Generate excerpt dari konten
        $plainContent = strip_tags($request->content);
        $excerpt = Str::limit($plainContent, 200);

        // Update prestasi
        $prestasi->title = $request->title;
        $prestasi->content = $request->content;
        $prestasi->excerpt = $excerpt;

        $prestasi->save();

        return redirect()->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        try {
            // Hapus gambar utama jika ada
            if ($prestasi->image && Storage::disk('public')->exists($prestasi->image)) {
                Storage::disk('public')->delete($prestasi->image);
            }

            // Hapus gambar-gambar dalam content jika ada
            $this->deleteImagesFromContent($prestasi->content);

            $prestasi->delete();

            return redirect()->route('admin.prestasi.index')
                ->with('success', 'Prestasi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus prestasi: ' . $e->getMessage());
        }
    }

    /**
     * Upload gambar untuk Trix Editor
     */
    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB untuk gambar dalam content
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak valid atau terlalu besar (maksimal 2MB)'
            ], 400);
        }

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('prestasi/content', $fileName, 'public');

            $url = Storage::url($filePath);

            return response()->json([
                'success' => true,
                'url' => $url,
                'path' => $filePath
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload gambar: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Public methods untuk website
     */
    public function publicIndex(Request $request)
    {
        $query = Prestasi::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%")
                    ->orWhere('excerpt', 'LIKE', "%{$search}%");
            });
        }

        $prestasi = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('prestasi', compact('prestasi'));
    }

    /**
     * Display the specified public resource.
     */
    public function publicShow($slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();

        // Get related prestasi (excluding current article)
        $relatedPrestasi = Prestasi::where('id', '!=', $prestasi->id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('prestasi_detail', compact('prestasi', 'relatedPrestasi'));
    }

    /**
     * Helper method untuk menghapus gambar dari content
     */
    private function deleteImagesFromContent($content)
    {
        // Pattern untuk mencari URL gambar dalam content
        preg_match_all('/<img[^>]+src="([^"]+)"/', $content, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $imageUrl) {
                // Extract path dari URL
                $path = str_replace(Storage::url(''), '', $imageUrl);

                // Hapus gambar jika ada dan merupakan file lokal
                if (str_contains($path, 'prestasi/content/') && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }
    }

    /**
     * Method untuk cleanup gambar yang tidak terpakai dalam content
     */
    public function cleanupUnusedImages()
    {
        $allImages = Storage::disk('public')->files('prestasi/content');
        $usedImages = [];

        // Ambil semua prestasi dan cari gambar yang digunakan
        $allPrestasi = Prestasi::all();
        foreach ($allPrestasi as $prestasi) {
            preg_match_all('/<img[^>]+src="([^"]+)"/', $prestasi->content, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $imageUrl) {
                    $path = str_replace(Storage::url(''), '', $imageUrl);
                    if (str_contains($path, 'prestasi/content/')) {
                        $usedImages[] = $path;
                    }
                }
            }
        }

        // Hapus gambar yang tidak digunakan
        $deletedCount = 0;
        foreach ($allImages as $image) {
            if (!in_array($image, $usedImages)) {
                Storage::disk('public')->delete($image);
                $deletedCount++;
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deletedCount} gambar yang tidak terpakai"
        ]);
    }
}
