<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Http\Resources\StatusResource;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $status = Status::all();
            return StatusResource::collection($status)->
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = new Status;
        $status->status_pegawai = $request->status_pegawai;
        $status->bonus = $request->bonus;
        $status->save();
        return $status;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = Status::find($id);
        $template = [
            'data' => $status,
            'message' => 'Detail Data Status',
        ];
        return new StatusResource($status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $status = Status::find($id);
        // $status->bonus = $request->bonus;
        // $status->save();
        // return $status;
        $status  = Status::updateOrCreate(
            ['id' => $id],
            [
                'bonus' => $request->bonus,
            ]
        );
        if  ($status->wasChanged()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah!',
                'data' => $status
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ada perubahan!',
                'data' => $status
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();
        return $status;
    }
}
