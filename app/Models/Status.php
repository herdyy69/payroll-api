<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';
    protected $fillable = [
        'status_pegawai',
        'bonus',
    ];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }
}
