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
    public function halaman()
    {
        return view('tambahbuku');
    }

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

        return redirect()->route('tambahbuku')->with('succes', 'data buku berhasil di tambah');
    }

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

        return redirect()->route('listbuku')->with('success', 'Data buku berhasil diperbarui');
    }

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

        return view('baca-buku', compact('buku', 'path'));
    }


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

    public function listbukupinjam()
    {
        $pinjam = Auth::check() 
        ? Pinjam::with('buku')
            ->where('id_user', Auth::id())
            ->get()
        : collect([]);

        return view('pinjam', compact('pinjam'));
    }

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

    public function filter($filter)
    {
        if (strpos(url()->previous(),'beranda')){
            $buku = Buku::where('kategori',$filter)->orWhere('penulis', $filter)->get();

            return view('dashboard', compact('buku'));
        }
        elseif (strpos(url()->previous(), 'listpinjam')) {
            $pinjam = Pinjam::with('buku')->whereHas('buku', function ($query) use ($filter) {
                $query->where('kategori', $filter)->orWhere('penulis', $filter);
            })->get();

            return view('listpinjam', compact('pinjam'));

        }elseif (strpos(url()->previous(),'pinjam')) {
            $pinjam = Pinjam::with('buku')->whereHas('buku', function ($query) use ($filter) {
                $query->where('kategori', $filter)->orWhere('penulis', $filter);
            })->get();

            return view('pinjam', compact('pinjam'));

        }elseif (strpos(url()->previous(), 'listbuku')) {
            $buku = Buku::where('kategori',$filter)->orWhere('penulis', $filter)->get();

            return view('listbuku', compact('buku'));

        }elseif (strpos(url()->previous(), 'listpengembalian')) {
            $pengembalian = Pengembalian::with('buku')->whereHas('buku', function ($query) use ($filter) {
                $query->where('kategori', $filter)->orWhere('penulis', $filter);
            })->get();

            return view('listpengembalian', compact('pengembalian'));
        }
    }

    // public function search(Request $request)
    // {
    //     $search = $request->input('search');

    //     if (strpos(url()->previous(),'beranda')) {
    //         $buku = Buku::where('judul_buku', 'like', '%' . $search . '%')->get();
    //         return view('dashboard', compact('buku'));
    //     }
    //     elseif (strpos(url()->previous(), 'pinjam')) {
    //         $pinjam = Pinjam::with('buku')->whereHas('buku', function ($query) use ($search) {
    //             $query->where('judul_buku', 'like', '%' . $search . '%');
    //         })->get();
    //         dd($pinjam);
    //         return view('pinjam', compact('pinjam'));
    //     }
    // }
}