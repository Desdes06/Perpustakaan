<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Pengembalian;
use App\Models\Pinjam;
use App\Models\Rating;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;

class BukuController extends Controller
{
    public function storebuku(Request $request) // fungsi untuk menambah data buku
    {
        $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required',
            'penerbit_id' => 'required|exists:penerbit,id', 
            'tanggal_terbit' => 'required|date',
            'deskripsi' => 'required',
            'id_kategori' => 'required|exists:kategori,id',
            'foto' => 'image|mimes:jpeg,png,jpg|max:10240',
            'file_buku' => 'required|mimes:pdf'
        ],[
            'judul_buku.required' => 'Kolom ini tidak boleh kosong',
            'penulis.required' => 'Kolom ini tidak boleh kosong',
            'penerbit_id.required' => 'Kolom ini tidak boleh kosong',
            'tanggal_terbit.required' => 'Kolom ini tidak boleh kosong',
            'deskripsi.required' => 'Kolom ini tidak boleh kosong',
            'id_kategori.required' => 'Kolom ini tidak boleh kosong',
            'foto.max' => 'Foto tidak boleh melebihi 10Mb',
            'file_buku.required' => 'File buku tidak boleh kosong'
        ]);

        $penerbit = Penerbit::findOrFail($request->penerbit_id);

        $buku = Buku::create([
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'penerbit_id' => $penerbit->id,
            'tanggal_terbit' => $request->tanggal_terbit,
            'deskripsi' => $request->deskripsi,
            'id_kategori' => $request->id_kategori,
            'foto' => $request->hasFile('foto') ? $request->file('foto')->store('covers', 'public') : null,
            'file_buku' => $request->hasFile('file_buku') ? $request->file('file_buku')->store('file', 'public') : null,
        ]);

        $buku_id = $buku->id;

        $isbn = $this->generateISBN($buku_id, $penerbit->id);

        $buku->update(['isbn' => $isbn]);

        return redirect()->route('Admin.tambahbuku')->with('success', 'Data buku berhasil ditambah dengan ISBN: ' . $isbn);
    }

    private static function generateISBN($buku_id, $penerbit_id) // generate kode isbn
    {
        $prefix = "978"; 
        $group = "602";

        $penerbit = Penerbit::findOrFail($penerbit_id);
        $publisher = str_pad($penerbit->kode_isbn, 2, "0", STR_PAD_LEFT);

        $crc32_hash = crc32($buku_id . $penerbit_id);
        $title = substr($crc32_hash, -4);

        $partial_isbn = "{$prefix}{$group}{$publisher}{$title}";

        $partial_isbn = substr($partial_isbn, 0, 12);

        $total = 0;
        for ($i = 0; $i < 12; $i++) { 
            $digit = intval($partial_isbn[$i]);
            $total += ($i % 2 == 0) ? $digit : 3 * $digit;
        }
        $check_digit = (10 - ($total % 10)) % 10;

        return "{$prefix}-{$group}-{$publisher}-{$title}-{$check_digit}";
    }

    public function updatebuku(Request $request, $id) // update data buku
    {
        $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required', 
            'penerbit_id' => 'required|exists:penerbit,id',
            'tanggal_terbit' => 'required|date',
            'deskripsi' => 'required',
            'id_kategori' => 'required|exists:kategori,id',
            'foto' => 'image|mimes:jpeg,png,jpg|max:10240',
            'file_buku' => 'mimes:pdf'
        ]);

        $buku = Buku::findOrFail($id);
        $old_penerbit_id = $buku->penerbit_id;

        $buku->judul_buku = $request->judul_buku;
        $buku->penulis = $request->penulis;
        $buku->penerbit_id = $request->penerbit_id;
        $buku->tanggal_terbit = $request->tanggal_terbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->id_kategori = $request->id_kategori;

        if ($request->penerbit_id != $old_penerbit_id) {
            $buku->isbn = self::generateISBN($buku->id, $request->penerbit_id);
        }

        if ($request->hasFile('foto')) {
            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }
            $buku->foto = $request->file('foto')->store('covers', 'public');
        }

        if ($request->hasFile('file_buku')) {
            if ($buku->file_buku) {
                Storage::disk('public')->delete($buku->file_buku);
            }
            $buku->file_buku = $request->file('file_buku')->store('file', 'public');
        }

        $buku->save();

        return redirect()->route('admin.listbuku')->with('success', 'Data buku berhasil diperbarui');
    }

    public function destroyMultiple(Request $request) // hapus data buku
    {
        $ids = explode(',', $request->ids);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada buku yang dipilih.');
        }

        $bukuList = Buku::whereIn('id', $ids)->get();

        foreach ($bukuList as $buku) {
            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }

            if ($buku->file_buku) {
                Storage::disk('public')->delete($buku->file_buku);
            }
        }
        Buku::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus.');
    }

    public function deleteSelected(Request $request)// hapus data pengembalian
    {
        $ids = explode(',', $request->ids);
        Pengembalian::whereIn('id', $ids)->delete();
        
        return redirect()->back()->with('success', 'Data pengembalian berhasil dihapus');
    }

    public function deletepinjam(Request $request)// hapus data pinjam
    {
        $ids = explode(',', $request->ids);
        Pinjam::whereIn('id', $ids)->delete();
        
        return redirect()->back()->with('success', 'Data pinjam berhasil dihapus');
    }

    public function baca($hash) // fungsi untuk membuka file buku
    {
        $id = Hashids::decode($hash);

        if (empty($id)) {
            abort(404); 
        }

        $id = $id[0];

        $user = Auth::user();

        $buku = Buku::find($id);
        if (!$buku) {
            return abort(404, 'Buku tidak ditemukan.');
        }

        $pinjam = Pinjam::with('buku', 'user')->where('id_user', $user->id)
                        ->where('id_buku', $id)
                        ->where('status_buku', 'dipinjam')
                        ->first();

        if (!$pinjam) {
            return redirect('User/beranda')->with('error', 'Anda belum meminjam buku ini.');
        }               

        $path = public_path('storage/' . $buku->file_buku);
        if (!file_exists($path)) {
            return abort(404, 'File PDF tidak ditemukan.');
        }

        return view('/User/baca-buku', compact('buku', 'path'));
    }

    public function pinjam(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
        ]);

        $user = Auth::user();

        // Cek apakah data dengan id_user, id_buku, dan tanggal_pinjam yang sama sudah ada
        $existingPinjam = Pinjam::where('id_user', $user->id)
            ->where('id_buku', $request->id_buku)
            ->whereDate('tanggal_pinjam', now()->toDateString())
            ->first();

        if ($existingPinjam) {
            // Jika ada, update status_buku
            $existingPinjam->update([
                'status_buku' => 'dipinjam',
                'tanggal_kembali' => now()->addDays(5),
            ]);
        } else {
            // Jika belum ada, buat baru
            Pinjam::create([
                'id_user' => $user->id,
                'id_buku' => $request->id_buku,
                'tanggal_pinjam' => now(),
                'status_buku' => 'dipinjam', // Pastikan kamu menyimpan status juga
            ]);
        }

        return redirect()->back()->with('message', 'Buku berhasil dipinjam.');
    }

    public function pengembalian($id_buku) // fungsi untuk mengembalikan
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'Anda harus login untuk mengembalikan buku.');
        }

        $pinjam = Pinjam::where('id_buku', $id_buku)
            ->where('id_user', $user->id)
            ->orderByDesc('tanggal_pinjam')
            ->first();

        if (!$pinjam) {
            return redirect()->back()->with('error', 'Anda tidak meminjam buku ini.');
        }

        $pinjam->update([
            'status_buku' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        Riwayat::create([
            'id_buku' => $pinjam->id_buku,
            'id_user' => $pinjam->id_user,
            'tanggal_pinjam' => $pinjam->tanggal_pinjam,
            'tanggal_kembali' => now(),
        ]);

        Pengembalian::create([
            'id_buku' => $pinjam->id_buku,
            'id_user' => $pinjam->id_user,
            'tanggal_pengembalian' => now(),
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }

    public function detail($hash) // fungsi detail buku
    {
        $id = Hashids::decode($hash);

        if (empty($id)) {
            abort(404); 
        }

        $id = $id[0];

        $userId = Auth::id();

        $detail = Buku::with(['kategori','penerbit'])->findOrFail($id);

        $ratings = Rating::with('user')
            ->where('id_buku', $id)
            ->orderByRaw("CASE WHEN id_user = ? THEN 0 ELSE 1 END", [$userId])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('User.detail-buku', compact('detail', 'ratings'));
    }

    public function hpsriwayat($id) // fungsi hps riwayat
    {
        $riwayat = Riwayat::find($id);

        if (!$riwayat) {
            return back()->with('error', 'Riwayat tidak ditemukan.');
        }

        $riwayat->delete();

        return back()->with('success', 'Riwayat berhasil dihapus.');
    }

    public function rmkomen($id) // fungsi hps komentar
    {
        $comment = Rating::find($id);

        if (!$comment) {
            return back()->with('error', 'Komentar tidak ditemukan.');
        }
        
        if ($comment->id_user !== Auth::id()) {
            return back()->with('error', 'Anda tidak diizinkan menghapus komentar ini.');
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }

    public function storekomen(Request $request) // fungsi untuk komentar
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        $existingRating = Rating::where('id_user', Auth::id())
                            ->where('id_buku', $request->id_buku)
                            ->first();

        if ($existingRating) {
            return back()->with('error', 'Anda sudah memberikan rating untuk buku ini.');
        }

        Rating::create([
            'id_user' => Auth::id(),
            'id_buku' => $request->id_buku,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        $averageRating = Rating::where('id_buku', $request->id_buku)->avg('rating');

        Buku::where('id', $request->id_buku)->update([
            'rating' => $averageRating
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }

    public function filter($filter = null) // fungsi untuk ambildata dan filter, search
    {
        $search = request('search');
        $currentPath = request()->path();
        $path = explode('/', $currentPath)[0] . '/' . explode('/', $currentPath)[1];
        
        switch ($path) {
            case 'User/buku':
                $bukuuser = Buku::with(['kategori','penerbit'])
                    ->when($search, function ($query) use ($search) {
                        return $query->where('judul_buku', 'like', "%{$search}%");
                    })
                    ->when($filter, function ($query) use ($filter) {
                        return $query->where(function ($q) use ($filter) {
                            $q->where('id_kategori', $filter)
                                ->orWhere('penulis', 'like', "%{$filter}%");
                        });
                    })
                    ->latest('created_at')
                    ->paginate(21);
            
                return view('User.buku', compact('bukuuser'));                

            case 'User/pinjam':
                $pinjam = Pinjam::with(['buku.kategori', 'user'])
                    ->where('id_user', Auth::id())
                    ->where('status_buku', 'dipinjam')
                    ->whereHas('buku', function($q){
                        $q->whereNull('deleted_at');
                    }) 
                    ->when($search, function ($query) use ($search) {
                        return $query->whereHas('buku', function ($q) use ($search) {
                            $q->where('judul_buku', 'like', "%{$search}%");
                        });
                    })
                    ->when($filter, function ($query) use ($filter) {
                        return $query->whereHas('buku', function ($q) use ($filter) {
                            $q->where('id_kategori', $filter)
                                ->orWhere('penulis', $filter);
                        });
                    })
                    ->latest('created_at')
                    ->paginate(21);
            
                return view('User.pinjam', compact('pinjam'));

                case 'Admin/listbuku':
                    $buku = Buku::with(['kategori','penerbit'])
                                ->when($search, fn($query) => $query->where('judul_buku', 'like', "%{$search}%"))
                                ->when($filter, fn($query) => $query->where('id_kategori', $filter)->orWhere('penulis', $filter))
                                ->when(request('bulan'), function ($query) {
                                    return $query->whereMonth('created_at', request('bulan'))
                                                ->whereYear('created_at', request('tahun', date('Y')));
                                })
                                ->latest('created_at')
                                ->paginate(50);
                
                    return view('Admin.listbuku', compact('buku'));

                case 'Admin/listpinjam':
                    $pinjam = Pinjam::with(['buku.kategori', 'user'])
                        ->when($search, function ($query, $search) {
                            return $query->whereHas('buku', function ($q) use ($search) {
                                $q->whereRaw("LOWER(judul_buku) LIKE ?", ["%".strtolower($search)."%"])
                                  ->orWhereRaw("LOWER(status_buku) LIKE ?", ["%".strtolower($search)."%"]);
                            })->orWhereHas('user', function ($qUser) use ($search) {
                                $qUser->whereRaw("LOWER(username) LIKE ?", ["%" . strtolower($search) . "%"]);
                            });
                        })
                        ->when($filter, function ($query, $filter) {
                            return $query->whereHas('buku', function ($q) use ($filter) {
                                $q->where('id_kategori', $filter);
                            });
                        })
                        ->when($filter, function ($query, $filter) {
                            return $query->orWhereHas('buku', function ($q) use ($filter) {
                                $q->where('penulis', $filter);
                            });
                        })
                        ->when(request('bulan'), function ($query, $bulan) {
                            return $query->whereMonth('created_at', $bulan);
                        })
                        ->when(request('tahun'), function ($query, $tahun) {
                            return $query->whereYear('created_at', $tahun);
                        })
                        ->latest('created_at')
                        ->paginate(50);                
                
                return view('Admin.listpinjam', compact('pinjam'));                                

                case 'Admin/listpengembalian':
                    $pengembalian = Pengembalian::with(['buku.kategori', 'user'])
                        ->when($search, function ($query) use ($search) {
                            return $query->whereHas('buku', function ($q) use ($search) {
                                $q->where('judul_buku', 'like', "%{$search}%");
                            })->orWhereHas('user', function ($qUser) use ($search) {
                                $qUser->whereRaw("LOWER(username) LIKE ?", ["%" . strtolower($search) . "%"]);
                            });
                        })
                        ->when($filter, function ($query) use ($filter) {
                            return $query->whereHas('buku', function ($q) use ($filter) {
                                $q->where('id_kategori', $filter)
                                    ->orWhere('penulis', $filter);
                            });
                        })
                        ->when(request('bulan'), function ($query, $bulan) {
                            return $query->whereMonth('created_at', $bulan);
                        })
                        ->when(request('tahun'), function ($query, $tahun) { 
                            return $query->whereYear('created_at', $tahun);
                        })
                        ->latest('created_at')
                        ->paginate(50);                
                
            return view('Admin.listpengembalian', compact('pengembalian'));
        }
    }
}