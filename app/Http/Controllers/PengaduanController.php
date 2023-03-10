<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Excel;
use App\Exports\PengaduansExport;



class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // orderBy fungsinya untuk mengurutkan data
        // ASC: ascending-> terkecil ke terbesar
        // DESC : descending-> terbesar ke terkecil
        $data = Pengaduan::orderBy('created_at', 'DESC')
            ->simplePaginate(2);
        return view('index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        // simpan data tersebut ke fitur auth sebaga identitas
        $user = $request->only('email', 'password');
        // nesting if , if bersarang, if dalam if
        // kalau data login uda masuk ke fitur Auth,dicek lagi pake elseif
        // kalau data Auth tersebut rolenya admin maka masuk ke route dashboard
        // kalau data Auth role nya petugas maka masuk ke route     
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin'){
                return redirect('dashboard')->with('success','Berhasil Login!' );
            } elseif (Auth::user()->role == 'petugas') {
                return redirect('/data/petugas')->with('success','Berhasil Login!');
            }
        } else {
            return redirect()->back()->with('Erorr', 'Gagal Login!');
        }
    }
    // Request $request ditambahkan karena pada halaman data ada fitur search nya, dan akan mengambil data teks yg diinput search
    public function dashboard(Request $request)
    {
        // ambil data yg diinput ke input yg namanya search
        $search = $request->search;
        // where akan menacari data berdasarkan column nama
        // data yg diambil merupakan data yg di 'LIKE' (terdapat) teks yg dimasukan ke input search
        // contoh:ngisi input search data dengan 'fem'
        // bakal nyari data ke db yg column nama nya ada isi 'fem nya
        $pengaduans = Pengaduan:: with('response')->where('nama_lengkap', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        return view('dashboard', compact('pengaduans'));
    }

    public function dataPetugas(Request $request)
    {
        $search = $request->search;
        // with : ambil relasi (nama fungsi hasOne/hasMany/BelongsTo di modelnya),ambil data dr relasi itu
        $pengaduans = Pengaduan::with('response')->where('nama_lengkap', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        return view('data_petugas', compact('pengaduans'));
    }
    
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|min:8',
            'nama_lengkap' => 'required|min:3',
            'no_telp' => 'required|numeric',
            'pengaduan' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png,svg',
        ]);
        $image = $request->file('foto');
        $imgName = rand() . '.' . $image->extension();
        $path = public_path('assets/image/');
        $image->move($path, $imgName);

        // dd($request->all());
        Pengaduan::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'no_telp' => $request->no_telp,
            'pengaduan' => $request->pengaduan,
            'foto' => $imgName,
        ]);
        return redirect()->route('dashboard_admin')->with('success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit($pengaduan_id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */

    public function createPDF($id)
    {
        // ambil data yg akan ditampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
        $data = Pengaduan:: with('response')->where('id',$id)->get()->toArray();
        // kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial 
        view()->share('data', $data);
        // panggil view blade yg akan dicetak pdf serta data yg akan digunakan
        $pdf = PDF::loadView('print', $data)->setPaper('A4','landscape');
        return $pdf->download('pdf_file.pdf');
    }

    public function print()
    {
        // ambil data yg akan ditampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
        $data = Pengaduan::with('response')->get()->toArray();
        // kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial 
        view()->share('data', $data);
        // panggil view blade yg akan dicetak pdf serta data yg akan digunakan
        $pdf = PDF::loadView('print2', $data)->setPaper('A4','landscape');
        return $pdf->download('pdf_file.pdf');
    }

    public function createExcel()
    {
        // nama file yg akan terdownload
        $file_name = 'data_keseluruhan_pengaduan.xlsx';
        // mwmanggil file PengaduansExport dan mendowloadnya dengan nama seperi $file_name
        return Excel::download(new PengaduansExport, $file_name);
    }




    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function destroy($id)
    {
        // cari data yg dimaksud
        $data = Pengaduan::where('id', $id)->firstOrFail();
        // $data isinya-> nik sampe foto dr pengaduan
        // nikin variable yg isinya ngarah ke file foto terkait
        // public_path nyari file di folder public yg namanua sama kaya $data bagian foto
        $image = public_path('assets/image/' . $data['foto']);
        //    uda nemu fotonya, tinggal hapus fotonya pake unlink
        unlink($image);
        //    hapus $data yang isinya data->foto tadi, hapusnya di database
        $data->delete();
        Response::where('pengaduan_id',$id)->delete();
        //    settelehnya dikembalikan lg ke halaman awal
        return redirect()->back()->with('success,Berhasil menghapus data!');
    }
}
