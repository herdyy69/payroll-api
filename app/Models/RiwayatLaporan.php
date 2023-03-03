<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatLaporan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_laporans';

    protected $fillable = [
        'kode_laporan',
        'karyawan_id',
        'gaji_pokok',
        'bonus',
        'potongan_izin',
        'potongan_sakit',
        'potongan_alpa',
        'total_potongan',
        'total_gaji',
        'tanggal_laporan',
        'keterangan',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

}
