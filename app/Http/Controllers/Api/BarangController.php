<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;


class BarangController extends Controller
{
    public function index(): Collection
{
    return BarangModel::all();
}

public function store(Request $request): JsonResponse
{
    $request->validate([
        'kategori_id' => 'required|exists:m_kategori,kategori_id',
        'barang_kode' => 'required|unique:m_barang,barang_kode',
        'barang_nama' => 'required',
        'harga_beli' => 'required|numeric',
        'harga_jual' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $image = $request->file('image');
    $image->store('barang', 'public');

    $barang = BarangModel::create([
        'kategori_id' => $request->kategori_id,
        'barang_kode' => $request->barang_kode,
        'barang_nama' => $request->barang_nama,
        'harga_beli' => $request->harga_beli,
        'harga_jual' => $request->harga_jual,
        'image' => $image->hashName(),
    ]);

    return response()->json([
        'success' => true,
        'barang' => $barang,
    ]);
}
}