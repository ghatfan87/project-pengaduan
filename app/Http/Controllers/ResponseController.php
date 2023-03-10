<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Response;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit($pengaduan_id)
    {
        //ambil data response yg bakal dimunculin, data yang diambil data response yg report id nya sama kaya $report_id dari path dinamis {report_id}
        // kalau ada, datanya diambil satu/first {}
        // knp ga pake firstOrFail krn nanti bakal munculin not found view,kl pake first{} view nya tetep bakal ditampilin
        $pengaduan = Response::where ('pengaduan_id', $pengaduan_id)->first();
        // karena mau kirim data {$report_id} buat di route updatenya, jadi biar bisa dipake di blade kita simpen data path dinamis $report_id nya ke variable baru yg bakal di compact dan dipanggil blade nya 
        $report = $pengaduan_id;
        return view('response', compact('pengaduan', 'report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function updateResponse(Request $request, $report_id)
    {
        $request -> validate([
            'status' => 'required',
            'pesan' => 'required',
        ]);
        // updateOrCreate () fungsinya untuk melakukan update data kl emg di db response nya uda ada data yang punya report_id sama dgn $report_id dari path dinamis, kl gada data itu maka di create 
        // array pertama, acuan cari data nya
        // array kedua data yg dikirim
        // knp pake updateOrCreate? karena response ini kan kl td nya gada mau ditambahin tpn kl ada mau diupdate aja
        Response::updateOrCreate(
            [
                'pengaduan_id' => $report_id,
            ],
            [
                'status' => $request->status,
                'pesan' => $request->pesan,
            ]
        );
        return redirect()->route('data.petugas')->with('success', 'Berhasil Mengubah Data');
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
