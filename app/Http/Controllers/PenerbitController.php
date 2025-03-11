<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function Penerbitdata(){

        $penerbit = Penerbit::paginate(15);

        return view('Admin.Penerbit', compact('penerbit'));

    }

    public function tambahpenerbit(Request $request)
    {
        $request->validate([
            'kode_isbn' => 'required|string|unique:penerbit,kode_isbn|min:2|max:2',
            'nama_penerbit' => 'nullable|unique:penerbit,nama_penerbit'
        ], [
            'kode_isbn.required' => 'Kode ISBN wajib diisi',
            'kode_isbn.unique' => 'Kode ISBN sudah ada',
            'kode_isbn.min' => 'Kode ISBN harus 2 karakter',
            'kode_isbn.max' => 'Kode ISBN harus 2 karakter',
            'nama_penerbit.unique' => 'Nama penerbit sudah ada'
        ]);
    
        Penerbit::create([
            'kode_isbn' => $request->kode_isbn,
            'nama_penerbit' => $request->nama_penerbit
        ]);
    
        return redirect()->route('Admin.penerbit')->with('success', 'Penerbit berhasil ditambah');
    }    

    public function update(Request $request, $id)
    {
        $penerbit = Penerbit::findOrFail($id);

        $penerbit->update([
            'kode_isbn' => $request->kode_isbn,
            'nama_penerbit' => $request->nama_penerbit
        ]);
        
        return redirect()->back()->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        $ids = explode(',', $request->ids);
        Penerbit::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
