<body>
    <h1>Form Ubah Data User</h1>
    <a href="/user">Kembali</a>
    <br><br>
    @if ($data)
        <form method="post" action="{{ url('/user/ubah_simpan/' . $data->user_id) }}">
            @csrf
            @method('PUT')
            <label>Username</label>
            <input type="text" name="username" value="{{ $data->username }}" required>
            <br>
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $data->nama }}" required>
            <br>
            <label>Password</label>
            <input type="password" name="password">
            <br>
            <label>Level ID</label>
            <input type="number" name="level_id" value="{{ $data->level_id }}" required>
            <br><br>
            <input type="submit" value="Ubah">
        </form>
    @else
        <p>Data user tidak ditemukan.</p>
    @endif

</body>