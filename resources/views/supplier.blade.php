<!DOCTYPE html>
<html>

<head>
    <title>Data Supplier</title>
</head>

<body>
    <h1>Data Supplier</h1>
    <a href="{{ route('supplier/tambah') }}">+ Tambah Supplier</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>ID</td>
            <td>Kode</td>
            <td>Nama</td>
            <td>Alamat</td>
            <td>Telepon</td>
            <td>Email</td>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->supplier_id }}</td>
                <td>{{ $d->supplier_kode}}</td>
                <td>{{ $d->supplier_nama }}</td>
                <td>{{ $d->supplier_alamat }}</td>
                <td>{{ $d->supplier_telepon }}</td>
                <td>{{ $d->supplier_email }}</td>
                <td>
                    <a href="{{ url('/supplier/ubah/' . $d->supplier_id) }}">Ubah</a> |
                    <a href="{{ url('/supplier/hapus/' . $d->supplier_id) }}">Hapus</a>
                </td>
            </tr>
        @endforeach
    </table>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
</body>

</html>