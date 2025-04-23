<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
   public function index()
    {
        $user = auth()->user();

        return response()->json([
            'message' => 'Berhasil ambil data profile',
            'data' => $user
        ]);
    }

   public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        /** @var User $user */
        $user = auth()->user();

        // Hapus foto lama jika ada
        if ($user->foto && Storage::exists('public/foto/' . $user->foto)) {
            Storage::delete('public/foto/' . $user->foto);
        }

        // Upload foto baru
        $path = $request->file('foto')->store('public/foto');
        $namaFile = basename($path);

        // Update dan simpan
        $user->foto = $namaFile;
        $user->save(); // <-- ini akan jalan karena $user adalah instance User

        return response()->json([
            'message' => 'Foto berhasil diperbarui.',
            'foto_url' => asset('storage/foto/' . $user->foto)
        ]);
    }
}