<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email</title>
</head>
<body>
    <h1>Berhasil terkirim</h1>
    <ul>
        <li>{{$data->id_user}}</li>
        <li>{{$data->tugas->instansi->nama_instansi}}</li>
        <li>{{$data->tugas->komoditas->nama}}</li>
        <li>{{$data->tugas->lokasi->nama}}</li>
        <li>{{$data->harga}}</li>
        <li>{{$data->merek}}</li>
        <li>{{$data->valid}}</li>
        <li>{{$data->counted_at}}</li>
        <li>{{$data->kenaikan}}</li>
        <li>{{$data->komentar}}</li>
    </ul>
</body>
</html>