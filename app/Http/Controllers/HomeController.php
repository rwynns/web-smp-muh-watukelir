<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use App\Models\Prestasi;

class HomeController extends Controller
{
    public function index()
    {
        $beritaTerbaru = Berita::latest()->take(6)->get();
        $ekstrakurikuler = Ekstrakurikuler::all();
        $guruLimit = Guru::orderBy('nama')->take(4)->get();
        $guruAll = Guru::orderBy('nama')->get();
        $prestasiTerbaru = Prestasi::orderBy('created_at', 'desc')->take(3)->get();

        return view('index', [
            'beritaTerbaru' => $beritaTerbaru,
            'ekstrakurikuler' => $ekstrakurikuler,
            'guruLimit' => $guruLimit,
            'guruAll' => $guruAll,
            'prestasiTerbaru' => $prestasiTerbaru,
        ]);
    }
}
