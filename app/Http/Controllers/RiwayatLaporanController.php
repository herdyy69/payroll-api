<?php

namespace App\Http\Controllers;

use App\Models\RiwayatLaporan;
use App\Models\Karyawan;
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

    public function getFlutter()
    {
        $kar = Karyawan::all();
        $riwayatLaporan = RiwayatLaporan::all();

        foreach ($riwayatLaporan as $key => $value) {
            $karyawan = $kar->where('id', $value->karyawan_id)->first();
            $data[$key] = [
                // 'id' => $value->id,
                // 'karyawan_id' => $value->karyawan_id,
                'nik' => $karyawan->nik,
                'nama' => $karyawan->nama_pegawai,
                'tanggal_laporan' => $value->tanggal_laporan,
                'kode_laporan' => $value->kode_laporan,
                // 'gaji_pokok' => $value->gaji_pokok,
                // 'bonus' => $value->bonus,
                // 'potongan_gaji' => $value->potongan_gaji,
                // 'total_gaji' => $value->total_gaji,
                // 'created_at' => $value->created_at,
                // 'updated_at' => $value->updated_at,
            ];
        }

        return response()->json([
            'success' => 'true',
            'message' => 'List Data Karyawan',
            'data' =>  $data,
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
            'kode_laporan' => $request->kode_laporan,
            'gaji_pokok' => $request->gaji_pokok,
            'bonus' => $request->bonus,
            'potongan_izin' => $request->potongan_izin,
            'potongan_sakit' => $request->potongan_sakit,
            'potongan_alpa' => $request->potongan_alpa,
            'total_potongan' => $request->total_potongan = $request->potongan_izin + $request->potongan_sakit + $request->potongan_alpa,
            'total_gaji' => $request->total_gaji = $request->gaji_pokok + $request->bonus - $request->total_potongan,
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
