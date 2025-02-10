<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pengembalian;
use App\Models\Pinjam;
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
            'kategori' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'file_buku' => 'required|mimes:pdf'
        ], [
            'judul_buku.required' => 'kolom ini tidak boleh kosong',
            'penulis.required' => 'kolom ini tidak boleh kosong',
            'penerbit.required' => 'kolom ini tidak boleh kosong',
            'tanggal_terbit.required' => 'kolom ini tidak boleh kosong',
            'deskripsi.required' => 'kolom ini tidak boleh kosong',
            'kategori.required' => 'kolom ini tidak boleh kosong',
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
            'kategori' => $request['kategori'],
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
            'kategori' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:10240',
            'file_buku' => 'mimes:pdf'
        ]);

        $buku = Buku::findOrFail($id);
        
        $buku->judul_buku = $request->judul_buku;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tanggal_terbit = $request->tanggal_terbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kategori = $request->kategori;

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

    // fungsi untuk menghapus buku
    public function destroy($id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan.');
        }

        if ($buku->foto) {
            Storage::disk('public')->delete($buku->foto);
        }

        if ($buku->file_buku) {
            Storage::disk('public')->delete($buku->file_buku);
        }

        $buku->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus.');
    }

    // fungsi untuk mengambil file buku
    public function baca($id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return abort(404, 'Buku tidak ditemukan.');
        }

        $path = public_path('storage/' . $buku->file_buku);

        if (!file_exists($path)) {
            return abort(404, 'File PDF tidak ditemukan.');
        }

        return view('/User/baca-buku', compact('buku', 'path'));
    }

    // fungsi untuk meminjam buku
    public function pinjam(Request $request)
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

    // fungsi untuk mengembalikan
    public function pengembalian($id_buku)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'Anda harus login untuk mengembalikan buku.');
        }

        $pinjam = Pinjam::where('id_buku', $id_buku)
                        ->where('id_user', $user->id)
                        ->first();

        if (!$pinjam) {
            return redirect()->back()->with('error', 'Anda tidak meminjam buku ini.');
        }

        $pinjam->delete();

        Pengembalian::create([
            'id_buku' => $id_buku,
            'id_user' => $user->id,
            'tanggal_pengembalian' => now(),
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }

    // fungsi untuk filter buku
    public function filter($filter = null)
    {
        $search = request('search');
        $currentPath = request()->path();
        $path = explode('/', $currentPath)[0] . '/' . explode('/', $currentPath)[1];
        
        switch ($path) {
            case 'User/beranda':
                $buku = Buku::where(function ($query) use ($filter, $search) {
                    if ($search) {
                        $query->where('judul_buku', 'like', '%' . $search . '%');
                    }
                    if (!empty($filter)) {
                        $query->where(function ($query) use ($filter) {
                            $query->where('kategori', $filter)
                                ->orWhere('penulis', $filter);
                        });
                    }
                })->paginate(6);
                return view('User.dashboard', compact('buku'));

            case 'Admin/listpinjam':
                $pinjam = Pinjam::with('buku')->whereHas('buku', function ($query) use ($filter, $search) {
                    if ($search) {
                        $query->where('judul_buku', 'like', "%{$search}%");
                    }
                    if (!empty($filter)) {
                        $query->where(function ($q) use ($filter) {
                            $q->where('kategori', $filter)
                                ->orWhere('penulis', $filter);
                        });
                    }
                })->paginate(15);
                return view('Admin.listpinjam', compact('pinjam'));

            case 'User/pinjam':
                $pinjam = Pinjam::with(['buku' => function ($query) use ($filter, $search) {
                    if ($search) {
                        $query->where('judul_buku', 'like', "%{$search}%");
                    }
                    if (!empty($filter)) {
                        $query->where(function ($q) use ($filter) {
                            $q->where('kategori', $filter)
                                ->orWhere('penulis', $filter);
                        });
                    }
                }])
                ->where('id_user', Auth::id())
                ->whereHas('buku', function ($query) use ($filter, $search) {
                    if ($search) {
                        $query->where('judul_buku', 'like', "%{$search}%");
                    }
                    if (!empty($filter)) {
                        $query->where(function ($q) use ($filter) {
                            $q->where('kategori', $filter)
                                ->orWhere('penulis', $filter);
                        });
                    }
                })->paginate(6);
                return view('User.pinjam', compact('pinjam'));

            case 'Admin/listbuku':
                $buku = Buku::where(function ($query) use ($filter, $search) {
                    if ($search) {
                        $query->where('judul_buku', 'like', '%' . $search . '%');
                    }
                    if (!empty($filter)) {
                        $query->where(function ($query) use ($filter) {
                            $query->where('kategori', $filter)
                                ->orWhere('penulis', $filter);
                        });
                    }
                })->paginate(6);
                return view('Admin.listbuku', compact('buku'));

            case 'Admin/listpengembalian':
                $pengembalian = Pengembalian::with('buku')->whereHas('buku', function ($query) use ($filter, $search) {
                    if ($search) {
                        $query->where('judul_buku', 'like', "%{$search}%");
                    }
                    if (!empty($filter)) {
                        $query->where(function ($q) use ($filter) {
                            $q->where('kategori', $filter)
                                ->orWhere('penulis', $filter);
                        });
                    }
                })->paginate(15);
            return view('Admin.listpengembalian', compact('pengembalian'));
        }
    }
}