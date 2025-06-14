<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::latest()->paginate(10);
        return view('admin.ekstrakurikuler.index', compact('ekstrakurikuler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Buat direktori jika belum ada
            $storagePath = storage_path('app/public/ekstrakurikuler');
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0775, true);
            }

            // Upload gambar
            $file = $request->file('gambar');
            $filename = time() . '_' . str_replace(' ', '_', $request->nama) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('ekstrakurikuler', $filename, 'public');

            // Simpan data ekstrakurikuler
            Ekstrakurikuler::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'gambar_path' => $path,
            ]);

            return redirect()->route('admin.ekstrakurikuler.index')
                ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
        }

        return redirect()->back()
            ->with('error', 'Gagal mengupload gambar. Silakan coba lagi.')
            ->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.show', compact('ekstrakurikuler'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update nama dan deskripsi
        $ekstrakurikuler->nama = $request->nama;
        $ekstrakurikuler->deskripsi = $request->deskripsi;

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if (Storage::disk('public')->exists($ekstrakurikuler->gambar_path)) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar_path);
            }

            // Upload gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . str_replace(' ', '_', $request->nama) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('ekstrakurikuler', $filename, 'public');
            $ekstrakurikuler->gambar_path = $path;
        }

        $ekstrakurikuler->save();

        return redirect()->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        try {
            // Hapus file gambar jika ada
            if (Storage::disk('public')->exists($ekstrakurikuler->gambar_path)) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar_path);
            }

            // Hapus data dari database
            $ekstrakurikuler->delete();

            return redirect()->route('admin.ekstrakurikuler.index')
                ->with('success', 'Ekstrakurikuler berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.ekstrakurikuler.index')
                ->with('error', 'Terjadi kesalahan saat menghapus ekstrakurikuler: ' . $e->getMessage());
        }
    }

    /**
     * Display ekstrakurikuler for frontend users.
     */
    public function frontendIndex()
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('ekstrakurikuler', compact('ekstrakurikuler'));
    }

    /**
     * Display the specified ekstrakurikuler for frontend users.
     */
    public function frontendShow($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('ekstrakurikuler-detail', compact('ekstrakurikuler'));
    }
}
