<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak  Data Pengaduan</title>
</head>
<body>  
    <h2 style="text-align: center; margin-bottom:20px;">Data Keseluruhan Pengaduan</h2>
    <table style="width: 100%;">
        <tr>
            <th>No</th>
            <th>Nik</th>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Tanggal</th>
            <th>Pengaduan</th>
            <th>Gambar</th>
            <th>Status Response</th>
            <th>Pesan Response</th>
        </tr>
        @php $no=1; @endphp
        @foreach ($data as $dt)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$dt['nik']}}</td>
            <td>{{$dt['nama_lengkap']}}</td>
            <td>{{$dt['no_telp']}}</td>
            <td>{{\Carbon\Carbon::parse($dt['created_at'])->format('j F,Y')}}</td>
            <td>{{$dt['pengaduan']}}</td>
            <td><img src="assets/image/{{$dt['foto']}}" width="80"></td>
            <td>
                @if ($dt['response'])
                {{ $dt['response']['status'] }}
                @else 
                - 
                @endif
            </td>
            <td>
                @if ($dt['response'])
                {{ $dt['response']['pesan'] }}
                @else
                - 
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    
</body>
</html>