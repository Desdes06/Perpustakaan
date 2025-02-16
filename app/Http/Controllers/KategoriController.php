<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function kategoridata(){

        $kategoris = Kategori::paginate(15);

        return view('Admin.kategori', compact('kategoris'));

    }

    public function tambahkategori(Request $request){
        
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategori,nama_kategori',
            'deskripsi' => 'nullable'
        ],[
            'nama_kategori.required' => 'Mohon masukan nama kategorinya',
            'nama_kategori.unique' => 'Nama Kategori sudah ada'
        ]);

        Kategori::create([
           'nama_kategori' =>  $request['nama_kategori'],
           'deskripsi' => $request['deskripsi']
        ]);

        return redirect()->route('Admin.viewkategori')->with('success', 'Kategori berhasil di tambah');
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);
        
        return redirect()->back()->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        $ids = explode(',', $request->ids);
        Kategori::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
