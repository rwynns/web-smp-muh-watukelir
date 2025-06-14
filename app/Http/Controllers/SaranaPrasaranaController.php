<?php

namespace App\Http\Controllers;

use App\Models\SaranaPrasarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaranaPrasaranaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $saranaPrasarana = SaranaPrasarana::latest()->paginate(10);
            return view('admin.sarana-prasarana.index', compact('saranaPrasarana'));
        } catch (\Exception $e) {
            // Debugging
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sarana-prasarana.create');
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
            $storagePath = storage_path('app/public/sarana-prasarana');
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0775, true);
            }

            // Upload gambar
            $file = $request->file('gambar');
            $filename = time() . '_' . str_replace(' ', '_', $request->nama) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('sarana-prasarana', $filename, 'public');

            // Simpan data sarana prasarana
            SaranaPrasarana::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'gambar_path' => $path,
            ]);

            return redirect()->route('admin.sarana-prasarana.index')
                ->with('success', 'Sarana dan Prasarana berhasil ditambahkan.');
        }

        return redirect()->back()
            ->with('error', 'Gagal mengupload gambar. Silakan coba lagi.')
            ->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(SaranaPrasarana $saranaPrasarana)
    {
        return view('admin.sarana-prasarana.show', compact('saranaPrasarana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaranaPrasarana $saranaPrasarana)
    {
        return view('admin.sarana-prasarana.edit', compact('saranaPrasarana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaranaPrasarana $saranaPrasarana)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update nama dan deskripsi
        $saranaPrasarana->nama = $request->nama;
        $saranaPrasarana->deskripsi = $request->deskripsi;

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if (Storage::disk('public')->exists($saranaPrasarana->gambar_path)) {
                Storage::disk('public')->delete($saranaPrasarana->gambar_path);
            }

            // Upload gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . str_replace(' ', '_', $request->nama) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('sarana-prasarana', $filename, 'public');
            $saranaPrasarana->gambar_path = $path;
        }

        $saranaPrasarana->save();

        return redirect()->route('admin.sarana-prasarana.index')
            ->with('success', 'Sarana dan Prasarana berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaranaPrasarana $saranaPrasarana)
    {
        try {
            // Hapus file gambar jika ada
            if (Storage::disk('public')->exists($saranaPrasarana->gambar_path)) {
                Storage::disk('public')->delete($saranaPrasarana->gambar_path);
            }

            // Hapus data dari database
            $saranaPrasarana->delete();

            return redirect()->route('admin.sarana-prasarana.index')
                ->with('success', 'Sarana dan Prasarana berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.sarana-prasarana.index')
                ->with('error', 'Terjadi kesalahan saat menghapus sarana prasarana: ' . $e->getMessage());
        }
    }

    /**
     * Display sarana prasarana for frontend users.
     */
    public function frontendIndex()
    {
        $saranaPrasarana = SaranaPrasarana::all();
        return view('sarana-prasarana', compact('saranaPrasarana'));
    }

    /**
     * Display the specified sarana prasarana for frontend users.
     */
    public function frontendShow($id)
    {
        $saranaPrasarana = SaranaPrasarana::findOrFail($id);
        return view('sarana-prasarana-detail', compact('saranaPrasarana'));
    }
}
