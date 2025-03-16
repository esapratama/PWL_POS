<?php
 
 namespace App\Http\Controllers;
 
 use App\Models\KategoriModel;
 use App\Models\BarangModel;
 use Yajra\DataTables\Facades\DataTables;
 use Illuminate\Http\Request;
 
 class BarangController extends Controller
 {
     public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Barang',
             'list' => ['Home', 'Barang']
         ];
 
         $page = (object) [
             'title' => 'Daftar Barang yang terdaftar di sistem'
         ];
 
         $activeMenu = 'barang';
 
         $kategori = KategoriModel::all();
 
         return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
     }
 
    public function list(Request $request)
{
    $barang = BarangModel::with('kategori')->select('barang_id', 'nama_barang', 'harga', 'stok', 'kategori_id');

    if ($request->kategori_id) {
        $barang->where('kategori_id', $request->kategori_id);
    }

    return DataTables::of($barang)
        ->addIndexColumn() // Menambahkan kolom index otomatis
        ->addColumn('kategori_nama', function ($row) {
            return $row->kategori->nama_kategori ?? '-';
        })
        ->addColumn('aksi', function ($row) {
            return '<a href="'.url('barang/edit/'.$row->barang_id).'" class="btn btn-sm btn-warning">Edit</a>
                    <a href="'.url('barang/delete/'.$row->barang_id).'" class="btn btn-sm btn-danger">Hapus</a>';
        })
        ->rawColumns(['aksi']) // Biarkan HTML untuk tombol aksi
        ->make(true);
}

     public function create()
     {
         $breadcrumb = (object) [
             'title' => 'Tambah Barang',
             'list' => ['Home', 'Barang', 'Tambah']
         ];
 
         $page = (object) [
             'title' => 'Tambah Barang baru'
         ];
 
         $activeMenu = 'barang';
 
         $kategori = KategoriModel::all();
 
         return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
     }
 
     public function store(Request $request)
     {
         $request->validate([
             'kategori_id' => 'required',
             'barang_id' => 'required',
             'nama_barang' => 'required',
             'harga' => 'required',
             'stok' => 'required',
         ]);
 
         BarangModel::create($request->all());
 
         return redirect('/barang')->with('success', 'Data berhasil ditambahkan');
     }
 
     public function show($id)
     {
         $breadcrumb = (object) [
             'title' => 'Detail Barang',
             'list' => ['Home', 'Barang', 'Detail']
         ];
 
         $page = (object) [
             'title' => 'Detail Barang yang terdaftar di sistem'
         ];
 
         $activeMenu = 'barang';
 
         $barang = BarangModel::with('kategori')->find($id);
 
         return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'barang' => $barang]);
     }
 
     public function edit($id)
     {
         $breadcrumb = (object) [
             'title' => 'Edit Barang',
             'list' => ['Home', 'Barang', 'Edit']
         ];
 
         $page = (object) [
             'title' => 'Edit Barang yang terdaftar di sistem'
         ];
 
         $activeMenu = 'barang';
 
         $barang = BarangModel::find($id);
         $kategori = KategoriModel::all();
 
         return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'barang' => $barang, 'kategori' => $kategori]);
     }
 
     public function update(Request $request, $id)
     {
         $request->validate([
             'kategori_id' => 'required',
             'barang_id' => 'required|unique:m_barang,barang_kode,' . $id . ',barang_id',
             'nama_barang' => 'required',
             'harga' => 'required',
             'stok' => 'required',
         ]);
 
         BarangModel::find($id)->update($request->all());
 
         return redirect('/barang')->with('success', 'Data berhasil diubah');
     }
 
     public function destroy($id)
     {
         $check = BarangModel::find($id);
         if (!$check) {
             return redirect('/user')->with('error', 'Data user tidak ditemukan');
         }
 
         try {
             BarangModel::destroy($id);
 
             return redirect('/user')->with('success', 'Data user berhasil dihapus');
         } catch (\Exception $e) {
             return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
         }
     }
 }