<!DOCTYPE html>
<html>

<head>
    <title>Data Supplier</title>
</head>

<body>
    <h1>Form Ubah Data Supplier</h1>
    <a href="/supplier">Kembali</a>
    <br><br>

    @if ($supplier)
        <form method="post" action="{{ url('/supplier/ubah_simpan/' . $supplier->supplier_id) }}">
            @csrf
            @method('PUT')
            <label>Kode Supplier</label>
            <input type="text" name="supplier_kode" placeholder="Masukan Kode Supplier" required>
            <br>

            <label>Nama Supplier</label>
            <input type="text" name="supplier_nama" placeholder="Masukan Nama Supplier" required>
            <br>

            <label>Alamat Supplier</label>
            <input type="text" name="supplier_alamat" placeholder="Masukan Alamat Supplier" required>
            <br>

            <label>Telepon Supplier</label>
            <input type="text" name="supplier_telepon" placeholder="Masukan Nomor Telepon" required>
            <br>

            <label>Email Supplier</label>
            <input type="email" name="email_telepon" placeholder="Masukan Email" required>
            <br>
            <br><br>
            <input type="submit" value="Ubah">
        </form>
    @else
        <p>Data supplier tidak ditemukan.</p>
    @endif
</body>

</html>