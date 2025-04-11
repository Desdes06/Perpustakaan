<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use App\Models\Pesans;

class SidebarAdmin extends Component
{
    public $user;
    public $totalPesan; // Tambahkan properti untuk menyimpan jumlah pesan

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = Auth::user();
        $this->totalPesan = Pesans::count(); // Hitung jumlah pesan langsung di sini
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-admin', [
            'user' => $this->user,
            'totalPesan' => $this->totalPesan, // Kirim ke view
        ]);
    }
}
