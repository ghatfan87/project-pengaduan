<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h2>Laporan Keluhan(Petugas)</h2>
    <div class="tombol"> <a href="{{route ('logout')}}">Logout | <a href="/">Home</a></a> </div>
   
    <div style="display: flex; justify-content:flex-end; align-items:center;">
    <!-- menggunakan method GET krn route untuk masuk ke halaman data ini menggunakan::get -->
        <form action="" method="GET">
            @csrf
            <input type="text" name="search" placeholder="Cari Berdasarkan Nama..">
            <button type="submit" class="btn-login">Search</button>
        </form>
        <!-- refresh balik lg ke route data karena nnti pas di klik refresh itu
        bersihin riwayat pencarian sebelumnya dan balikin lagi nya ke halaman data lg-->
    </div>
    <a class="btn-login" href="{{route('dashboard_admin')}}"style="position:relative; text-decoration:none; bottom:10px; color:black; align-items">Refresh</a>

    <div style="overflow-x: auto;">
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nik</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Pengaduan</th>
                <th>Gambar</th>
                <th>Status Responses</th>
                <th>Pesan Responses</th>
                <th style="width: 150px;">Aksi</th>
            </tr>
            @php
            $i = 1;
            @endphp


            @foreach ($pengaduans as $pd)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$pd->nik}}</td>
                <td>{{$pd->nama_lengkap}}</td>
                <td>{{$pd->no_telp}}</td>
                <td>{{$pd->pengaduan}}</td>
                <td><img src="{{asset('assets/image/'. $pd->foto)}}" alt="" width="200px"></td>
                <td>
                    {{-- cek apakah data report ini sudah memiliki rlasi dengan data dr with response--}}
                    @if ($pd->response)
                    {{ $pd->response['status'] }}
                    {{-- kl ada hasil relasi nya, tampilkan bagian status --}}
                    @else 
                    {{-- kl gada tampilkan tanda ini --}}
                    - 
                    @endif
                </td>
                <td>
                  {{-- cek apakah data report ini sudah memiliki rlasi dengan data dr with (response) --}}
                    @if ($pd->response)
                    {{ $pd->response['pesan'] }}
                    {{-- kl ada hasil relasi nya, tampilkan bagian status --}}
                    @else 
                    {{-- kl gada tampilkan tanda ini --}}
                    - 
                    @endif
                </td>
                <td>
                   <a href="{{route('response.edit', $pd->id)}}" class="btn-login">Send Response</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
@include('sweetalert::alert')

</html>


<style>
    h2 {
        text-align: center;
    }

    .tombol {
        text-align: center;
        margin-bottom: 13px;
    }

    table {
        width: 100%;
        border: 2px solid;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    .btn {
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: orange;
        border: 2px solid #e74c3c;
        border-radius: 0.6em;
        color: #e74c3c;
        cursor: pointer;
        display: flex;
        align-self: center;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1;
        margin: 5px;
        padding: 5px 10px;
        text-decoration: none;
        text-align: center;
        text-transform: uppercase;
        font-family: 'Montserrat', sans-serif;
        font-weight: 400;
    }

    .btn:hover,
    .btn:focus {
        color: #fff;
        outline: 0;
    }

    .third {
        border-color: orange;
        color: #fff;
        box-shadow: 0 0 40px 40px orange inset, 0 0 0 0 orange;
        transition: all 150ms ease-in-out;
    }

    .third:hover {
        box-shadow: 0 0 10px 0 red inset, 0 0 10px 4px red;
    }

    .btn-login{
    width: auto;
    padding: 8px 10px;
    border: none;
    border-radius: 20px;
    background-color: #e3a930;
    cursor: pointer;
    color: black;
    text-decoration: none
    }

    .btn-login:hover{
        background-color: chocolate;
    }
</style>