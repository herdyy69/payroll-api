<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JabatanResource extends JsonResource
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
            'jabatan_pegawai' => $this->jabatan_pegawai,
            'gaji_pokok' => $this->gaji_pokok,
            'uang_makan' => $this->uang_makan,
            'uang_transport' => $this->uang_transport,
            'bonus' => $this->bonus,
        ];
    }
}
