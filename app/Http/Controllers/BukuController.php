<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function halaman()
    {
        return view('tambahbuku');
    }

    public function get()
    {
        $buku = Buku::all();
        return view('dashboard', compact('buku'));  
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
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $path = null ;
        if ($request->hasFile('foto')){
            $path = $request->file('foto')->store('covers', 'public');
        }

        Buku::create([
            'judul_buku' => $request['judul_buku'],
            'penulis' => $request['penulis'],
            'penerbit' => $request['penerbit'],
            'tanggal_terbit' => $request['tanggal_terbit'],
            'deskripsi' => $request['deskripsi'],
            'kategori' => $request['kategori'],
            'foto' => $path
            ]);

        return redirect()->route('tambahbuku')->with('succes', 'data buku berhasil di tambah');
    }
}
