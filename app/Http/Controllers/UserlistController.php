<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class UserlistController extends Controller
{
    public function userlist(Request $request)
    {
        $search = $request->get('search');

        $anggota = User::with(['pinjam.buku', 'pengembalian.buku'])->where('role_id', 1)
            ->when($search, function ($query, $search) {
                $query->where('username', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(15);

        return view('Admin.anggota', compact('anggota'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('Auth.profile', compact('user'));
    }

    public function editProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $imagePath = $request->file('foto')->store('foto', 'public');
            $user->foto = $imagePath;
        }

        $user->save();

        return redirect('/Auth/profile')->with('success', 'Profil berhasil diperbarui!');
    }

}