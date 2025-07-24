<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\PPDB;
use App\Models\Ekstrakurikuler;
use App\Models\SaranaPrasarana;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache dashboard data for 5 minutes
        $cacheKey = 'dashboard_data_' . (Auth::check() ? Auth::user()->id : 'guest');

        $dashboardData = Cache::remember($cacheKey, 300, function () {
            // Statistik dashboard dengan query yang dioptimasi
            $stats = [
                'total_users' => User::count(),
                'total_berita' => Berita::count(),
                'total_prestasi' => Prestasi::count(),
                'total_galeri' => Galeri::count(),
                'berita_bulan_ini' => Berita::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count(),
            ];

            // Aktivitas terkini dengan eager loading
            $activities = collect();

            // Ambil berita terbaru dengan user relationship
            $recent_berita = Berita::with(['user:id,name'])
                ->select('id', 'title', 'created_at', 'user_id')
                ->latest()
                ->limit(3)
                ->get();

            foreach ($recent_berita as $berita) {
                $activities->push([
                    'type' => 'berita',
                    'icon' => 'fas fa-newspaper',
                    'color' => 'primary',
                    'title' => 'Berita Baru Ditambahkan',
                    'description' => 'Admin menambahkan berita "' . Str::limit($berita->title, 40) . '"',
                    'time' => $berita->created_at,
                    'user' => $berita->user->name ?? 'Admin'
                ]);
            }

            // Ambil prestasi terbaru
            $recent_prestasi = Prestasi::select('id', 'title', 'created_at')
                ->latest()
                ->limit(2)
                ->get();

            foreach ($recent_prestasi as $prestasi) {
                $activities->push([
                    'type' => 'prestasi',
                    'icon' => 'fas fa-trophy',
                    'color' => 'success',
                    'title' => 'Prestasi Baru Ditambahkan',
                    'description' => 'Prestasi "' . Str::limit($prestasi->title, 40) . '" berhasil direkam',
                    'time' => $prestasi->created_at,
                    'user' => 'Admin'
                ]);
            }

            // Ambil galeri terbaru
            $recent_galeri = Galeri::select('id', 'title', 'created_at')
                ->latest()
                ->limit(2)
                ->get();

            foreach ($recent_galeri as $galeri) {
                $activities->push([
                    'type' => 'galeri',
                    'icon' => 'fas fa-image',
                    'color' => 'info',
                    'title' => 'Foto Galeri Ditambahkan',
                    'description' => 'Foto "' . Str::limit($galeri->title, 40) . '" ditambahkan ke galeri',
                    'time' => $galeri->created_at,
                    'user' => 'Admin'
                ]);
            }

            // Ambil user baru terdaftar (7 hari terakhir)
            $recent_users = User::select('id', 'name', 'created_at')
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->latest()
                ->limit(2)
                ->get();

            foreach ($recent_users as $user) {
                $activities->push([
                    'type' => 'user',
                    'icon' => 'fas fa-user-plus',
                    'color' => 'warning',
                    'title' => 'Pengguna Baru Terdaftar',
                    'description' => 'Pengguna "' . $user->name . '" telah terdaftar',
                    'time' => $user->created_at,
                    'user' => 'System'
                ]);
            }

            // Urutkan aktivitas berdasarkan waktu (terbaru dulu)
            $activities = $activities->sortByDesc('time')->take(6);

            return compact('stats', 'activities');
        });

        // Format waktu untuk bahasa Indonesia
        $dashboardData['activities'] = $dashboardData['activities']->map(function ($activity) {
            $activity['formatted_time'] = $this->formatTimeIndonesian($activity['time']);
            return $activity;
        });

        return view('admin.dashboard', $dashboardData);
    }

    /**
     * Format waktu ke bahasa Indonesia
     */
    private function formatTimeIndonesian($time)
    {
        $now = Carbon::now();
        $diff = $time->diffInSeconds($now);

        if ($diff < 60) {
            return 'Baru saja';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $minutes . ' menit yang lalu';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' jam yang lalu';
        } elseif ($diff < 604800) {
            $days = floor($diff / 86400);
            return $days . ' hari yang lalu';
        } else {
            return $time->format('d/m/Y H:i');
        }
    }
}
