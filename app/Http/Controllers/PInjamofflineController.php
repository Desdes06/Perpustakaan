<?php

namespace App\Http\Controllers;

use App\Models\PinjamOffline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PInjamofflineController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
            'nama_lengkap' => 'required',
            'email' => 'required|email:dns',
            'no_tel' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ],[
            'nama_lengkap.required' => 'isi nama lengkap terlebih dahulu',
            'email.required' => 'email harus di isi',
            'no_tel.required' => 'nomor telphone harus di isi',
            'tanggal_pinjam.required' => 'tanggal peminjaman belum di isi',
            'tanggal_kembali.required' => 'tanggal pengembalian buku belum terisi'
        ]);

        $user = Auth::user();

        $existingPinjam = PinjamOffline::where('id_user', $user->id)
            ->where('id_buku', $request->id_buku)
            ->whereDate('tanggal_pinjam', now()->toDateString())
            ->first();

        if ($existingPinjam) {
            $existingPinjam->update([
                'status' => 'Pending',
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_tel' => $request->no_tel,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
            ]);
        } else {
            PinjamOffline::create([
                'id_buku' => $request->id_buku,
                'id_user' => $user->id,
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_tel' => $request->no_tel,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
            ]);
        }

        return redirect()->back()->with(['message' => 'Peminjaman berhasil, tunggu konfimasi dari admin']);
    }

    public function update($id)
    {
        $pinjam = PinjamOffline::findOrFail($id);

        $pinjam->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);

        return redirect()->back()->with(['message' => 'Buku telah di kembalikan']);
    }

    public function konfirmasi($id)
    {
        $pinjam = PinjamOffline::findOrFail($id);

        $pinjam->update([
            'status' => 'Dipinjam'
        ]);

        $pinjam->save();
    }
}
