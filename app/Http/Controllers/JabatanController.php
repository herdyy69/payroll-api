<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Http\Resources\JabatanResource;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = Jabatan::all();
        return JabatanResource::collection($jabatan)->
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
        $jabatan = new Jabatan;
        $jabatan->jabatan_pegawai = $request->jabatan_pegawai;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->uang_makan = $request->uang_makan;
        $jabatan->uang_transport = $request->uang_transport;
        $jabatan->bonus = $request->bonus;
        $jabatan->save();
        return $jabatan;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        $jabatan = Jabatan::find($jabatan->id);
        $template = [
            'data' => $jabatan,
            'message' => 'Detail Data Jabatan',
        ];
        return new JabatanResource($jabatan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $jabatan = Jabatan::find($jabatan);
        $jabatan->jabatan_pegawai = $request->jabatan_pegawai;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->uang_makan = $request->uang_makan;
        $jabatan->uang_transport = $request->uang_transport;
        $jabatan->bonus = $request->bonus;
        $jabatan->save();
        return $jabatan;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan = Jabatan::find($jabatan->id);
        $jabatan->delete();
        return new JabatanResource($jabatan);
    }
}
