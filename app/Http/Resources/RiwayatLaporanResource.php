<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatLaporanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'kode' => $this->kode_laporan,
            'nik' => $this->karyawan->nik,
            'nama_karyawan' => $this->karyawan->nama_pegawai,
            'jabatan' => $this->karyawan->jabatan->jabatan_pegawai,
            'status' => $this->karyawan->status->status_pegawai,
            'gaji_pokok' => $this->gaji_pokok,
            'bonus' => $this->bonus,
            'potongan_izin' => $this->potongan_izin,
            'potongan_sakit' => $this->potongan_sakit,
            'potongan_alpa' => $this->potongan_alpa,
            'total_potongan' => $this->total_potongan,
            'total_gaji' => $this->total_gaji,
            'tanggal' => $this->tanggal_laporan,
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at,
        ];
        
    }
}
