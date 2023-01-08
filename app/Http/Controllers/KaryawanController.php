<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Resources\KaryawanResource;
use Illuminate\Http\Request;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::all();
        return KaryawanResource::collection($karyawan, 200)->
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
        // status akan otomatis diisi dengan aktif apabila tidak diisi
        
        $karyawan = new Karyawan;
        $karyawan->pegawai = $request->pegawai;
        $karyawan->nama_pegawai = $request->nama_pegawai;
        $karyawan->nik = $request->nik;
        $karyawan->alamat = $request->alamat;
        $karyawan->no_telp = $request->no_telp;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->tempat_lahir = $request->tempat_lahir;
        $karyawan->tanggal_lahir = $request->tanggal_lahir;
        $karyawan->status_hubungan = $request->status_hubungan;
        $karyawan->agama = $request->agama;
        $karyawan->foto = $request->foto;
        $karyawan->tanggal_masuk = $request->tanggal_masuk;
        $karyawan->tanggal_keluar = $request->tanggal_keluar;
        $karyawan->lama_kerja = $request->lama_kerja;
        $karyawan->keterangan = $request->keterangan;
        // rekening
        $karyawan->nama_bank = $request->nama_bank;
        $karyawan->no_rekening = $request->no_rekening;
        $karyawan->atas_nama = $request->atas_nama;
        //end rekening
        $karyawan->jabatan_id = $request->jabatan_id;
        $karyawan->status_id = $request->status_id;
        $karyawan->save();

        return $karyawan;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        // jika data tidak ada 
        if (is_null($karyawan)) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'data' => $karyawan
            ], 404);
        }
        return new KaryawanResource($karyawan, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $karyawan = Karyawan::updateOrCreate(
            ['id' => $karyawan->id],
            [
                'pegawai' => $request->pegawai,
                'nama_pegawai' => $request->nama_pegawai,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'status_hubungan' => $request->status_hubungan,
                'agama' => $request->agama,
                'foto' => $request->foto,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
                'lama_kerja' => $request->lama_kerja,
                'keterangan' => $request->keterangan,
                // rekening
                'nama_bank' => $request->nama_bank,
                'no_rekening' => $request->no_rekening,
                'atas_nama' => $request->atas_nama,
                //end rekening
                'jabatan_id' => $request->jabatan_id,
                'status_id' => $request->status_id,
            ]
        );
        if ($karyawan->wasChanged()) {
            return new KaryawanResource($karyawan);
        } else {
            return response()->json([
                'message' => 'Data tidak berubah',
                'data' => $karyawan
            ], 200);
        }
    }

    public function updateStatus(Request $request, Karyawan $karyawan)
    {

        $karyawan = Karyawan::updateOrCreate(
            ['id' => $karyawan->id],
            ['status_id' => $request->status_id]
        );
        if ($karyawan->wasChanged()) {
            return new KaryawanResource($karyawan);
        } else {
            return response()->json([
                'message' => 'Data tidak berubah',
                'data' => $karyawan
            ], 200);
        }
    }

    public function updateJabatan(Request $request, Karyawan $karyawan)
    {
            $karyawan = Karyawan::updateOrCreate(
                ['id' => $karyawan->id],
                ['jabatan_id' => $request->jabatan_id]
            );
            if ($karyawan->wasChanged()) {
                return new KaryawanResource($karyawan);
            } else {
                return response()->json([
                    'message' => 'Data tidak berubah',
                    'data' => $karyawan
                ], 200);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        //delete
        $karyawan = Karyawan::find($karyawan->id);
        $karyawan->delete();
        return response()->json([
            'message' => 'Data ' . $karyawan->nama_pegawai . ' berhasil dihapus',
            'data' => $karyawan
        ], 200);
    }
    public function destroyAll(Karyawan $karyawan)
    {
        $karyawan = Karyawan::all()
            ->each(function ($karyawan) {
                $karyawan->delete();
            });
            // length data
            $length = count($karyawan);
        return response()->json([
            'message' => 'Semua data berhasil dihapus',
            'data' => $karyawan
        ], 200);
    }
}
