<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use App\Models\SupplierModel;
 use Yajra\DataTables\Facades\DataTables;
 use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\Log;
 use App\Models\KategoriModel;
 use PhpOffice\PhpSpreadsheet\IOFactory;
 use Barryvdh\DomPDF\Facade\Pdf;
 
 class SupplierController extends Controller
 {
     public function index()
    {
        $activeMenu = 'supplier';
        $breadcrumb = (object)[
            'title' => 'Data Supplier',
            'list' => ['Home', 'Supplier']
        ];

        return view('supplier.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb
        ]);
    }
 
     public function list(Request $request)
     {
         $supplier = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat', 'supplier_telepon', 'supplier_email');
 
         return DataTables::of($supplier)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                $btn = '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/detail_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
 
    //  public function destroy($id)
    //  {
    //      $check = SupplierModel::find($id);
    //      if (!$check) {
    //          return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
    //      }
 
    //      try {
    //          SupplierModel::destroy($id);
 
    //          return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
    //      } catch (\Exception $e) {
    //          return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    //      }
    //  }

     public function create_ajax()
     {
         return view('supplier.create_ajax');
     }
 
     public function store_ajax(Request $request)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'supplier_kode' => 'required|unique:m_supplier',
                //  'supplier_nama' => 'required',
                //  'supplier_alamat' => 'required',
                //  'supplier_telepon' => 'required',
                 'supplier_nama' => ['required', 'string', 'max:100'],
                 'supplier_alamat' => ['required', 'string'],
                 'supplier_telepon' => ['required', 'string'],
                 'supplier_email' => ['required', 'email'],
             ];
 
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors(),
                 ]);
             }
 
             SupplierModel::create($request->all());
             return response()->json([
                 'status' => true,
                 'message' => 'Data Supplier berhasil disimpan'
             ]);
         }
         return redirect('/');
     }
     public function show_ajax(string $id)
     {
         $supplier = SupplierModel::find($id);
         return view('supplier.show_ajax', ['supplier' => $supplier]);
     }
 
     public function edit_ajax($id)
     {
         $supplier = SupplierModel::find($id);
 
         return view('supplier.edit_ajax', ['supplier' => $supplier]);
     }
 
     public function update_ajax(Request $request, $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'supplier_kode' => 'required|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
                 'supplier_nama' => ['required', 'string', 'max:100'],
                 'supplier_alamat' => ['required', 'string'],
                 'supplier_telepon' => ['required', 'string'],
                 'supplier_email' => ['required', 'email'],
             ];
 
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors(),
                 ]);
             }
 
             $check = SupplierModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
 
     public function confirm_ajax($id)
     {
         $supplier = SupplierModel::find($id);
 
         return view('supplier.confirm_ajax', ['supplier' => $supplier]);
     }
 
     public function delete_ajax(Request $request, $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
            try {
                $check = SupplierModel::find($id);
                if ($check) {
                    $check->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak ditemukan'
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Error deleting user: ' . $e->getMessage());
                if (str_contains($e->getMessage(), 'SQLSTATE[23000]')) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak dapat dihapus karena masih terkait dengan data lain di sistem'
                    ]);
                }
            }
        }
        return redirect('/');
     }

     public function import()
    {
        return view('supplier.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_supplier' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file_supplier');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);
            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'kode' => $value['A'],
                            'nama' => $value['B'],
                            'alamat' => $value['C'],
                            'telepon' => $value['D'],
                            'email' => $value['E'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    SupplierModel::insertOrIgnore($insert);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }

    public function export_excel()
    {
        $supplier = SupplierModel::select('kode', 'nama', 'alamat', 'telp', 'email')->get();
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Telepon');
        $sheet->setCellValue('F1', 'Email');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;
        foreach ($supplier as $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->kode);
            $sheet->setCellValue('C' . $baris, $value->nama);
            $sheet->setCellValue('D' . $baris, $value->alamat);
            $sheet->setCellValue('E' . $baris, $value->telepon);
            $sheet->setCellValue('F' . $baris, $value->email);
            $baris++;
            $no++;
        }

        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Supplier');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Supplier - ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        $supplier = SupplierModel::select('kode', 'nama', 'alamat', 'telp', 'email')
            ->orderBy('supplier_id')
            ->get();

        $pdf = Pdf::loadView('supplier.export_pdf', ['supplier' => $supplier]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['isRemoteEnabled' => true]);
        return $pdf->stream('Data Supplier - ' . date('Y-m-d H:i:s') . '.pdf');
    }
}