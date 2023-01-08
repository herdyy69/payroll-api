<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';

    protected $fillable = [
        'pegawai',
        'nama_pegawai',
        'nik',
        'alamat',
        'no_telp',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_hubungan',
        'agama',
        'foto',
        'jabatan_id',
        'status_id',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function riwayatlaporan()
    {
        return $this->hasMany(RiwayatLaporan::class);
    }

    public function foto()
    {
        if ($this->foto && file_exists(public_path('images/foto_karyawan/' . $this->foto))) {
            return asset('images/foto_karyawan/' . $this->foto);
        }
        return asset('images/foto_karyawan/default.png');
    }
    public function deleteFoto(){
        if ($this->foto && file_exists(public_path('images/foto_karyawan/' . $this->foto))) {
            unlink(public_path('images/foto_karyawan/' . $this->foto));
        }
    }
}

