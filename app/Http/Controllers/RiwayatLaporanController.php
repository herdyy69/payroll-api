<?php

namespace App\Http\Controllers;

use App\Models\RiwayatLaporan;
use App\Http\Resources\RiwayatLaporanResource;
use Illuminate\Http\Request;

class RiwayatLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayatLaporan = RiwayatLaporan::all();
        return RiwayatLaporanResource::collection($riwayatLaporan)->
        additional([
            'meta' => [
                'status' => 'success',
                'code' => 200,
            ],
        ], 200);
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
        $riwayatLaporan = RiwayatLaporan::firstOrCreate([
            'karyawan_id' => $request->karyawan_id,
            'tanggal_laporan' => $request->tanggal_laporan,
        ], [
            'keterangan' => $request->keterangan,
        ]);

        $riwayatLaporan->tanggal_laporan = date('d-m-Y', strtotime($riwayatLaporan->tanggal_laporan));

        if ($riwayatLaporan->wasRecentlyCreated) {
            return response()->json([
                'message' => 'Data laporan ' . $riwayatLaporan->karyawan->nama_pegawai . ' (' . $riwayatLaporan->tanggal_laporan . ')' . ' berhasil ditambahkan',
                'data' => $riwayatLaporan,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Data laporan ' . $riwayatLaporan->karyawan->nama_pegawai . ' (' . $riwayatLaporan->tanggal_laporan . ')' . ' sudah ada',
                'data' => $riwayatLaporan,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiwayatLaporan  $riwayatLaporan
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatLaporan $riwayatLaporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatLaporan  $riwayatLaporan
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatLaporan $riwayatLaporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatLaporan  $riwayatLaporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatLaporan $riwayatLaporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatLaporan  $riwayatLaporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatLaporan $riwayatLaporan)
    {
        //
    }
}
