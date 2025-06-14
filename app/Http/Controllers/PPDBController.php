<?php

namespace App\Http\Controllers;

use App\Models\PPDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPDBController extends Controller
{
    /**
     * Menampilkan halaman PPDB
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('ppdb');
    }

    /**
     * Menyimpan data pendaftaran
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'formulir_file' => 'required|file|mimes:pdf|max:10240', // max 10MB
        ]);

        // Buat direktori jika belum ada
        $storage_path = storage_path('app/public/formulir-ppdb');
        if (!file_exists($storage_path)) {
            mkdir($storage_path, 0775, true);
        }

        // Upload file
        $path = $request->file('formulir_file')->store('formulir-ppdb', 'public');

        // Simpan data ke database
        $pendaftaran = PPDB::create([
            'nama_lengkap' => $request->nama_lengkap,
            'formulir_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Formulir pendaftaran berhasil dikirim. Tim kami akan menghubungi Anda segera untuk proses selanjutnya.');
    }

    /**
     * Download template formulir
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTemplate()
    {
        // Ubah ekstensi dari .pdf menjadi .docx
        $path = public_path('downloads/template-ppdb.docx');

        if (!file_exists($path)) {
            abort(404, 'File template tidak ditemukan');
        }

        // Ubah nama file yang didownload
        return response()->download($path, 'Template-Formulir-PPDB-SMP-Muhammadiyah-Watukelir.docx');
    }

    /**
     * Admin: Menampilkan daftar pendaftaran PPDB
     *
     * @return \Illuminate\View\View
     */
    public function adminIndex(Request $request)
    {
        $query = PPDB::query();

        // Filter pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nama_lengkap', 'like', "%{$search}%");
        }

        // Sorting
        $sortBy = $request->sort_by ?? 'created_at';
        $direction = 'desc';

        if ($sortBy === 'nama_lengkap') {
            $direction = 'asc';
        }

        $query->orderBy($sortBy, $direction);

        // Pagination
        $pendaftaran = $query->paginate(10)->withQueryString();

        return view('admin.ppdb.index', compact('pendaftaran'));
    }

    /**
     * Admin: Menampilkan detail pendaftaran
     *
     * @param  \App\Models\Ppdb  $ppdb
     * @return \Illuminate\View\View
     */
    public function adminShow(Ppdb $ppdb)
    {
        return view('admin.ppdb.show', compact('ppdb'));
    }

    /**
     * Admin: Hapus pendaftaran
     *
     * @param  \App\Models\Ppdb  $ppdb
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminDestroy(Ppdb $ppdb)
    {
        // Hapus file formulir jika ada
        if ($ppdb->formulir_path) {
            Storage::delete('public/' . $ppdb->formulir_path);
        }

        $ppdb->delete();

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'Data pendaftaran berhasil dihapus');
    }
}
