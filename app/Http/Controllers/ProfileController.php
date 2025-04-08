<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $activeMenu = 'profile';
        $breadcrumb = (object)[
            'title' => 'Profile',
            'list' => ['Home', 'Profile']
        ];
        return view('profile.index', [
            'user' => $user,
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user(); // bantu intelephense tahu ini User

        // Hapus foto lama jika ada
        if ($user->foto && Storage::exists('public/foto/' . $user->foto)) {
            Storage::delete('public/foto/' . $user->foto);
        }

        // Upload dan simpan nama file
        $path = $request->file('foto')->store('public/foto');
        $namaFile = basename($path);

        // Update ke database
        $user->foto = $namaFile;
        $user->save(); // save akan jalan jika model User valid

        return back()->with('success', 'Foto berhasil diperbarui.');
    }
}