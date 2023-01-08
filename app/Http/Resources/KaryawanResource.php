<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanResource extends JsonResource
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
            'nama' => $this->nama_pegawai,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'status_hubungan' => $this->status_hubungan,
            'agama' => $this->agama,
            'foto' => $this->foto,
            'tanggal_masuk' => $this->tanggal_masuk,
            'tanggal_keluar' => $this->tanggal_keluar,
            'lama_kerja' => $this->lama_kerja,
            'keterangan' => $this->keterangan,
            'nama_bank' => $this->nama_bank,
            'no_rekening' => $this->no_rekening,
            'atas_nama' => $this->atas_nama,
            'status_pegawai' => $this->pegawai,
            'status_karyawan' => $this->status,
            'jabatan' => $this->jabatan,
        ];
    }
}
