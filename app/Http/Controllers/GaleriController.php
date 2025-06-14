<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Menampilkan daftar gambar di galeri.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $galeri = Galeri::latest()->paginate(12);
        return view('admin.galeri.index', compact('galeri'));
    }

    /**
     * Menampilkan form untuk membuat galeri baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Menyimpan galeri baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|max:5120|mimes:jpeg,png,jpg,gif', // Max 5MB
        ]);

        if ($request->hasFile('gambar')) {
            // Buat direktori jika belum ada
            $storagePath = storage_path('app/public/galeri');
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0775, true);
            }

            // Upload gambar
            $path = $request->file('gambar')->store('galeri', 'public');

            // Simpan data galeri
            Galeri::create([
                'judul' => $request->judul,
                'file_path' => $path,
            ]);

            return redirect()->route('admin.galeri.index')
                ->with('success', 'Gambar berhasil ditambahkan ke galeri.');
        }

        return redirect()->back()
            ->with('error', 'Gagal mengupload gambar. Silakan coba lagi.')
            ->withInput();
    }

    /**
     * Menampilkan halaman edit galeri.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\View\View
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update data galeri.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif', // Max 5MB
        ]);

        // Update judul
        $galeri->judul = $request->judul;

        // Jika ada upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($galeri->file_path && Storage::disk('public')->exists($galeri->file_path)) {
                Storage::disk('public')->delete($galeri->file_path);
            }

            // Upload gambar baru
            $path = $request->file('gambar')->store('galeri', 'public');
            $galeri->file_path = $path;
        }

        $galeri->save();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui');
    }

    /**
     * Menampilkan halaman detail galeri.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\View\View
     */
    public function show(Galeri $galeri)
    {
        return view('admin.galeri.show', compact('galeri'));
    }

    /**
     * Menghapus galeri.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Galeri $galeri)
    {
        try {
            // Hapus file gambar jika ada
            if ($galeri->file_path && Storage::disk('public')->exists($galeri->file_path)) {
                Storage::disk('public')->delete($galeri->file_path);
            }

            // Hapus data dari database
            $galeri->delete();

            return redirect()->route('admin.galeri.index')
                ->with('success', 'Gambar berhasil dihapus dari galeri');
        } catch (\Exception $e) {
            return redirect()->route('admin.galeri.index')
                ->with('error', 'Terjadi kesalahan saat menghapus gambar. ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan galeri di frontend.
     *
     * @return \Illuminate\View\View
     */
    public function frontendGaleri()
    {
        $galeri = Galeri::latest()->paginate(20);
        return view('galeri', compact('galeri'));
    }
}
