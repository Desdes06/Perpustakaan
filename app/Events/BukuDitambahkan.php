<?php

namespace App\Events;

use App\Models\Buku;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BukuDitambahkan implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $buku;

    /**
     * Create a new event instance.
     */
    public function __construct(Buku $buku)
    {
        $this->buku = $buku;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('buku'),
        ];
    }

    public function broadcastAs()
    {
        return 'buku.ditambahkan';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->buku->id,
            'judul_buku' => $this->buku->judul_buku,
            'penulis' => $this->buku->penulis,
            'penerbit_id' => $this->buku->penerbit_id,
            'tanggal_terbit' => $this->buku->tanggal_terbit,
            'deskripsi' => $this->buku->deskripsi,
            'id_kategori' => $this->buku->id_kategori,
            'isbn' => $this->buku->isbn,
            'foto' => asset('storage/' . $this->buku->foto),
            'file_buku' => asset('storage/' . $this->buku->file_buku),
        ];
    }
}