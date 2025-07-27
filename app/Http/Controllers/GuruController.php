<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::orderBy('nama')->get();
        return view('admin.guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ubah input jabatan (string) menjadi array per baris sebelum validasi
        if (!is_array($request->jabatan)) {
            $request->merge([
                'jabatan' => array_filter(array_map('trim', preg_split('/\r?\n/', $request->jabatan)))
            ]);
        }
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|array|min:1',
            'jabatan.*' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ];

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = 'guru_' . time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('guru', $filename, 'public');
            $data['foto'] = $path;
        }

        Guru::create($data);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return view('admin.guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        // Ubah input jabatan (string) menjadi array per baris sebelum validasi
        if (!is_array($request->jabatan)) {
            $request->merge([
                'jabatan' => array_filter(array_map('trim', preg_split('/\r?\n/', $request->jabatan)))
            ]);
        }
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|array|min:1',
            'jabatan.*' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ];

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }

            $foto = $request->file('foto');
            $filename = 'guru_' . time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('guru', $filename, 'public');
            $data['foto'] = $path;
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        // Delete foto if exists
        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}
