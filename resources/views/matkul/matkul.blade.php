<!DOCTYPE html>
<html>
<head>
    <title>Mata Kuliah</title>
</head>
<body>
    <h1>Tambah Matakuliah</h1>
    <form method="POST" action="/matkul">
        @csrf
        <input type="text" name="matkul" placeholder="Nama Matakuliah"><br><br>
        <input type="text" name="deskripsi" placeholder="Deskripsi"><br><br>
        <button type="submit">Simpan</button>
    </form>

    <h2>List Matakuliah</h2>
    <ul>
        @foreach($data as $matkul)
            <li>{{ $matkul->matkul}} - {{ $matkul->deskripsi }}</li></li>
        @endforeach
    </ul>
</body>
</html>

