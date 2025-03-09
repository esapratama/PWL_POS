<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Data User</title>
</head>

<body>
    <h1>Form Tambah Data User</h1>
    <form method="post" action="{{ url('/user/tambah_simpan') }}">
        {{ csrf_field() }}

        <label>Username</label><br>
        <input type="text" name="username" placeholder="Masukan Username" required>
        <br>

        <label>Nama</label><br>
        <input type="text" name="nama" placeholder="Masukan Nama" required>
        <br>

        <label>Password</label><br>
        <input type="password" name="password" placeholder="Masukan Password" required>
        <br>

        <label>Level ID</label><br>
        <input type="number" name="level_id" placeholder="Masukan ID Level" required>
        <br><br>

        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>

</html>