<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data Supplier</title>
</head>

<body>
    <h1>Form Tambah Data Supplier</h1>

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('supplier/tambah_simpan') }}">
        {{ csrf_field() }}

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

        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>

</html>