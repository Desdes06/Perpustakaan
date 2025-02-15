<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pengembalian;
use App\Models\Pinjam;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // fungsi untuk menambah data buku
    public function storebuku(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tanggal_terbit' => 'required|date',
            'deskripsi' => 'required',
            'id_kategori' => 'required|exists:kategori,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'file_buku' => 'required|mimes:pdf'
        ], [
            'judul_buku.required' => 'kolom ini tidak boleh kosong',
            'penulis.required' => 'kolom ini tidak boleh kosong',
            'penerbit.required' => 'kolom ini tidak boleh kosong',
            'tanggal_terbit.required' => 'kolom ini tidak boleh kosong',
            'deskripsi.required' => 'kolom ini tidak boleh kosong',
            'id_kategori.required' => 'kolom ini tidak boleh kosong',
            'foto.required' => 'foto tidak boleh kosong',
            'file_buku.required' => 'file buku tidak boleh kosong'
        ]);

        $path = null ;
        if ($request->hasFile('foto')){
            $path = $request->file('foto')->store('covers', 'public');
        }

        $pathfile = null ;
        if ($request->hasFile('file_buku')){
            $pathfile = $request->file('file_buku')->store('file', 'public');
        }
        
        Buku::create([
            'judul_buku' => $request['judul_buku'],
            'penulis' => $request['penulis'],
            'penerbit' => $request['penerbit'],
            'tanggal_terbit' => $request['tanggal_terbit'],
            'deskripsi' => $request['deskripsi'],
            'id_kategori' => $request['id_kategori'],
            'foto' => $path,
            'file_buku' => $pathfile
            ]);

        return redirect()->route('Admin.tambahbuku')->with('success', 'data buku berhasil di tambah');
    }

    // fungsi untuk mengubah data buku
    public function updatebuku(Request $request, $id)
    {
        $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required', 
            'penerbit' => 'required',
            'tanggal_terbit' => 'required|date',
            'deskripsi' => 'required',
            'id_kategori' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:10240',
            'file_buku' => 'mimes:pdf'
        ]);

        $buku = Buku::findOrFail($id);
        
        $buku->judul_buku = $request->judul_buku;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tanggal_terbit = $request->tanggal_terbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->id_kategori = $request->kategori;

        if ($request->hasFile('foto')) {
            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }
            $path = $request->file('foto')->store('covers', 'public');
            $buku->foto = $path;
        }
        if ($request->hasFile('file_buku')) {
            if ($buku->file_buku) {
                Storage::disk('public')->delete($buku->file_buku);
            }
            $pathfile = $request->file('file_buku')->store('file', 'public');
            $buku->file_buku = $pathfile;
        }

        $buku->save();

        return redirect()->route('Admin.buku')->with('success', 'Data buku berhasil diperbarui');
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

    public function baca($id) // fungsi untuk membuka file buku
    {
        $user = Auth::user();

        $buku = Buku::find($id);
        if (!$buku) {
            return abort(404, 'Buku tidak ditemukan.');
        }

        $pinjam = Pinjam::where('id_user', $user->id)
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

    public function pinjam(Request $request) // fungsi untuk meminjam buku
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
        ]);

        $user = Auth::user();

        Pinjam::create([
            'id_user' => $user->id,
            'id_buku' => $request->id_buku, 
            'tanggal_pinjam' => now()
        ]);

        return redirect()->back()->with('message', 'Buku berhasil dipinjam.');
    }

    public function pengembalian($id_buku) // fungsi untuk mengembalikan
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'Anda harus login untuk mengembalikan buku.');
        }

        Pinjam::where('id_buku', $id_buku)
                    ->where('id_user', $user->id)
                    ->update([
                        'status_buku' => 'dikembalikan',
                        'tanggal_kembali' => now(),
                    ]);

        $pinjam =  Pinjam::where('id_buku', $id_buku)
            ->where('id_user', $user->id)
            ->first();

        if (!$pinjam) {
            return redirect()->back()->with('error', 'Anda tidak meminjam buku ini.');
        }
        
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

    public function filter($filter = null) // fungsi untuk filter buku, search, dan ambil data
    {
        $search = request('search');
        $currentPath = request()->path();
        $path = explode('/', $currentPath)[0] . '/' . explode('/', $currentPath)[1];
        
        switch ($path) {
            case 'User/beranda':
            case 'Admin/listbuku':
                $buku = Buku::with('kategori')
                            ->when($search, fn($query) => $query->where('judul_buku', 'like', "%{$search}%"))
                            ->when($filter, fn($query) => $query->where('id_kategori', $filter)->orWhere('penulis', $filter))
                            ->latest()
                            ->paginate(6);
            
                return view($path === 'User/beranda' ? 'User.dashboard' : 'Admin.listbuku', compact('buku'));
                
            case 'User/pinjam':
                $pinjam = Pinjam::with(['buku', 'user'])
                    ->where('id_user', Auth::id())
                    ->where('status_buku', 'dipinjam') 
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
                    ->latest()
                    ->paginate(6);
            
                return view('User.pinjam', compact('pinjam'));

            case 'Admin/listpinjam':
                $pinjam = Pinjam::with(['buku', 'user'])
                    ->where('status_buku', 'dipinjam')
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
                    ->when(request('bulan'), function ($query) {
                        return $query->whereMonth('created_at', request('bulan'))
                                     ->whereYear('created_at', request('tahun', date('Y')));
                    })
                    ->latest()
                    ->paginate(50);
            
                return view('Admin.listpinjam', compact('pinjam'));                

            case 'Admin/listpengembalian':
                $pengembalian = Pengembalian::with(['buku', 'user'])
                    ->when($search, function ($query) use ($search) {
                        return $query->whereHas('buku', function ($q) use ($search) {
                            $q->where('judul_buku', 'like', "%{$search}%");
                        });
                    })
                    ->when($filter, function ($query) use ($filter) {
                        return $query->whereHas('buku', function ($q) use ($filter) {
                            $q->where('id_kategori', $filter)->orWhere('penulis', $filter);
                        });
                    })
                    ->when(request('bulan'), function ($query) {
                        return $query->whereMonth('created_at', request('bulan'))
                                     ->whereYear('created_at', request('tahun', date('Y')));
                    })
                    ->latest()
                    ->paginate(50);
                
            return view('Admin.listpengembalian', compact('pengembalian'));
        }
    }
}