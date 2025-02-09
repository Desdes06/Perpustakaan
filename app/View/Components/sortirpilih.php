<?php

namespace App\View\Components;

use App\Models\Buku;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sortirpilih extends Component
{
    public $type;
    public $buku;
    /**
     * Create a new component instance.
     */
    public function __construct($type = "")
    {
        $this->type=$type;
        $this->buku = Buku::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sortirpilih',  ['type' => $this->type, 'buku' => $this->buku]);
    }
}
