<!DOCTYPE html>
<html>
<head>
    <title>Ruangan</title>
</head>
<body>
    <h1>Tambah Ruangan</h1>
    <form method="POST" action="/ruangan">
        @csrf
        <input type="text" name="nm_ruangan" placeholder="Nama ruangan"><br><br>
        <input type="text" name="kapasitas" placeholder="Kapasitas"><br><br>
        <button type="submit">Simpan</button>
    </form>

    <h2>List Matakuliah</h2>
    <ul>
        @foreach($data as $ruang)
            <li>{{ $ruang->nm_ruangan}} - Kapasitas : {{ $ruang->kapasitas }}</li></li>
        @endforeach
    </ul>
</body>
</html>

