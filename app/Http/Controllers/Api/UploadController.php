<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\KategoriModel;
use App\Models\BarangModel;

class UploadController extends Controller
{
    public function uploadUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'level_id' => 'required|exists:m_level,level_id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageName = $request->file('image')?->store('image', 'public');

        $user = UserModel::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'level_id' => $request->level_id,
            'image' => $imageName,
        ]);

        return response()->json($user);
    }

    public function uploadKategori(Request $request)
    {
        $request->validate([
            'kategori_nama' => 'required',
            'kategori_kode' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $image = $request->file('image')?->store('image', 'public');

        $kategori = KategoriModel::create([
            'kategori_nama' => $request->kategori_nama,
            'kategori_kode' => $request->kategori_kode,
            'image' => $image,
        ]);

        return response()->json($kategori);
    }

    public function uploadBarang(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $image = $request->file('image')?->store('image', 'public');

        $barang = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $image,
        ]);

        return response()->json($barang);
    }

    public function getAllData()
    {
        return response()->json([
            'user' => UserModel::with('level')->get(),
            'kategori' => KategoriModel::all(),
            'barang' => BarangModel::with('kategori')->get(),
        ]);
    }
}
