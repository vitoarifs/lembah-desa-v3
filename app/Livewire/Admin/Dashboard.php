<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Event;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function mount(): void
    {
        // Authorization check untuk role admin dan content_manager
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'content_manager'])) { 
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.'); 
        }
    }

    public function render()
    {
        // Statistik Utama dengan penanganan fallback apabila model/tabel belum ada
        $totalMenus = class_exists(Menu::class) ? Menu::count() : 0;
        $totalCategories = class_exists(Category::class) ? Category::count() : 0;
        $totalEvents = class_exists(Event::class) ? Event::count() : 0;
        
        // Statistik Pesan Masuk
        $unreadMessages = class_exists(ContactMessage::class) ? ContactMessage::where('is_read', false)->count() : 0;
        $recentMessages = class_exists(ContactMessage::class) ? ContactMessage::latest()->take(5)->get() : collect();

        return view('livewire.admin.dashboard', [
            'totalMenus' => $totalMenus,
            'totalCategories' => $totalCategories,
            'totalEvents' => $totalEvents,
            'unreadMessages' => $unreadMessages,
            'recentMessages' => $recentMessages,
            'lastUpdated' => now()->translatedFormat('d F Y, H:i'),
        ]);
    }
}