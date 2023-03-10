<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    <form action="{{route('response.update', $report)}}" method="POST" style="width:500px; margin:50px auto; display:block ">
        @csrf
        @method('PATCH')
          <div class="input-card">
              <label for="">Status :</label>
              @if ($pengaduan)
              <select name="status">
                <option selected hidden disabled>Pilih Status</option>
                <option value="Ditolak" {{$pengaduan['status'] == 'Ditolak' ? 'selected' : ""}}>Ditolak</option>
                <option value="Proses" {{$pengaduan['status'] == 'Proses' ? 'selected' : ""}}>Proses</option>
                <option value="Diterima" {{$pengaduan['status'] == 'Diterima' ? 'selected' : ""}}>Diterima</option>
              </select>
              @else
              <select name="status" id="status">
                <option selected hidden disabled ="Pilih Status"></option>
                <option value="Ditolak">Ditolak</option>
                <option value="Proses">Proses</option>
                <option value="Diterima">Diterima</option>
              </select>
            @endif
          </div>
          <div class="input-card">
            <label for="">Pesan :</label>
            <textarea name="pesan" id="pesan" rows="3" >{{$pengaduan ? $pengaduan['pesan'] : '' }}</textarea>
          </div>
          <div>
              <button style="width: 100%" type="submit">Kirim</button>
        </div>
</body>