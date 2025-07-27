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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ];

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Buat direktori jika belum ada
            $storagePath = storage_path('app/public/ekstrakurikuler');
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0775, true);
            }

            $file = $request->file('gambar');
            $filename = time() . '_gambar_' . str_replace(' ', '_', $request->nama) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('ekstrakurikuler', $filename, 'public');
            $data['gambar_path'] = $path;
        }

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            // Buat direktori jika belum ada
            $storagePath = storage_path('app/public/ekstrakurikuler');
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0775, true);
            }

            $file = $request->file('logo');
            $filename = time() . '_logo_' . str_replace(' ', '_', $request->nama) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('ekstrakurikuler', $filename, 'public');
            $data['logo_path'] = $path;
        }

        // Simpan data ekstrakurikuler
        Ekstrakurikuler::create($data);

        return redirect()->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update nama dan deskripsi
        $ekstrakurikuler->nama = $request->nama;
        $ekstrakurikuler->deskripsi = $request->deskripsi;

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($ekstrakurikuler->gambar_path && Storage::disk('public')->exists($ekstrakurikuler->gambar_path)) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar_path);
            }

            // Upload gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_gambar_' . str_replace(' ', '_', $request->nama) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('ekstrakurikuler', $filename, 'public');
            $ekstrakurikuler->gambar_path = $path;
        }

        // Update logo jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($ekstrakurikuler->logo_path && Storage::disk('public')->exists($ekstrakurikuler->logo_path)) {
                Storage::disk('public')->delete($ekstrakurikuler->logo_path);
            }

            // Upload logo baru
            $file = $request->file('logo');
            $filename = time() . '_logo_' . str_replace(' ', '_', $request->nama) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('ekstrakurikuler', $filename, 'public');
            $ekstrakurikuler->logo_path = $path;
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
            if ($ekstrakurikuler->gambar_path && Storage::disk('public')->exists($ekstrakurikuler->gambar_path)) {
                Storage::disk('public')->delete($ekstrakurikuler->gambar_path);
            }

            // Hapus file logo jika ada
            if ($ekstrakurikuler->logo_path && Storage::disk('public')->exists($ekstrakurikuler->logo_path)) {
                Storage::disk('public')->delete($ekstrakurikuler->logo_path);
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
