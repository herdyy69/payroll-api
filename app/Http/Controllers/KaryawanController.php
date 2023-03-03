<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Resources\KaryawanResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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

    public function getFlutter()
    {
        $karyawan = Karyawan::all();
        return response()->json([
            'success' => 'true',
            'message' => 'List Data Karyawan',
            // convert all to string
            'data' =>  $karyawan->map(function ($item) {
                if ($item->foto == null) {
                    $item->foto = 'https://www.pngitem.com/pimgs/m/146-1468479_my-profile-icon-blank-profile-picture-circle-hd.png';
                }
                if ($item->jabatan_id === 1) {
                    $item->jabatan_id = 'Human Resource Development';
                } elseif ($item->jabatan_id === 2) {
                    $item->jabatan_id = 'Chief Executive Officer';
                } elseif ($item->jabatan_id === 3) {
                    $item->jabatan_id = 'Manager';
                }
                elseif ($item->jabatan_id === 4) {
                    $item->jabatan_id = 'Supervisor';
                }
                elseif ($item->jabatan_id === 5) {
                    $item->jabatan_id = 'Staff';
                } elseif ($item->jabatan_id === 6) {
                    $item->jabatan_id = 'Salesman';
                }
                elseif ($item->jabatan_id === 7) {
                    $item->jabatan_id = 'Driver(Sopir)';
                }

                if ($item->status_id === 1) {
                    $item->status_id = 'Tetap';
                } elseif ($item->status_id === 2) {
                    $item->status_id = 'Kontrak';
                } elseif ($item->status_id === 3) {
                    $item->status_id = 'Magang';
                }
                
                return [
                    // 'id' => (string) $item->id,
                    'pegawai' => (string) $item->pegawai,
                    'nama_pegawai' => (string) $item->nama_pegawai,
                    'nik' => (string) $item->nik,
                    // 'alamat' => (string) $item->alamat,
                    // 'no_telp' => (string) $item->no_telp,
                    // 'email' => (string) $item->email,
                    // 'jenis_kelamin' => (string) $item->jenis_kelamin,
                    // 'tempat_lahir' => (string) $item->tempat_lahir,
                    // 'tanggal_lahir' => (string) $item->tanggal_lahir,
                    // 'status_hubungan' => (string) $item->status_hubungan,
                    // 'agama' => (string) $item->agama,
                    'foto' => (string) $item->foto,
                    // 'tanggal_masuk' => (string) $item->tanggal_masuk,
                    // 'tanggal_keluar' => (string) $item->tanggal_keluar,
                    // 'lama_kerja' => (string) $item->lama_kerja,
                    // 'keterangan' => (string) $item->keterangan,
                    // 'nama_bank' => (string) $item->nama_bank,
                    // 'no_rekening' => (string) $item->no_rekening,
                    // 'atas_nama' => (string) $item->atas_nama,
                    'jabatan_id' => (string) $item->jabatan_id,
                    'status_id' => (string) $item->status_id,
                ];
            }),
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

        if($request->jabatan_id == 1) {
        $validator = Validator::make($request->all(), [
            'nama_pegawai' => 'required|max:255',
            'nik'=> 'required|max:16|unique:karyawans',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|max:14',
            'jenis_kelamin' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'status_hubungan' => 'required|max:255',
            'agama' => 'required|max:255',
            'jabatan_id' => 'required|max:255',
            'status_id' => 'required|max:255', 
            // HRD AUTH
            'username' => 'required|max:15|unique:users',
            'email' => 'required|max:255|unique:karyawans|unique:users',
            'password' => 'required|string|min:8',
            // 'role' => 'required|string|',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->nama_pegawai,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'Human Resource Development',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
       
        $karyawan = new Karyawan;
        $karyawan->pegawai = $request->pegawai ?? 'Aktif';
        $karyawan->nama_pegawai = $request->nama_pegawai;
        $karyawan->nik = $request->nik;
        $karyawan->alamat = $request->alamat;
        $karyawan->no_telp = $request->no_telp;
        $karyawan->email = $request->email;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->tempat_lahir = $request->tempat_lahir;
        $karyawan->tanggal_lahir = $request->tanggal_lahir;
        $karyawan->status_hubungan = $request->status_hubungan;
        $karyawan->agama = $request->agama;
        $karyawan->foto = $request->foto;
        $today =              
        Carbon::today();

        $karyawan->tanggal_masuk = $request->tanggal_masuk ?? '2004-10-10';
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

        if ($karyawan) {
            return response()->json([
                'Profiles' => $karyawan,
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer Token'
            ], 200);
        }
        else {
            return response()->json([
                'message' => 'Failed to create new data',
                'status' => 'failed',
                'code' => 400,
            ], 400);
        }
    }
    else {
        $validator = Validator::make($request->all(), [
            'nama_pegawai' => 'required|max:255',
            'nik'=> 'required|max:16|unique:karyawans',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|max:14',
            'jenis_kelamin' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'status_hubungan' => 'required|max:255',
            'agama' => 'required|max:255',
            'jabatan_id' => 'required|max:255',
            'status_id' => 'required|max:255', 
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $karyawan = new Karyawan;
        $karyawan->pegawai = $request->pegawai ?? 'Aktif';
        $karyawan->nama_pegawai = $request->nama_pegawai;
        $karyawan->nik = $request->nik;
        $karyawan->alamat = $request->alamat;
        $karyawan->no_telp = $request->no_telp;
        $karyawan->email = $request->email;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->tempat_lahir = $request->tempat_lahir;
        $karyawan->tanggal_lahir = $request->tanggal_lahir;
        $karyawan->status_hubungan = $request->status_hubungan;
        $karyawan->agama = $request->agama;
        $karyawan->foto = $request->foto;
        $today = Carbon::today();
        $karyawan->tanggal_masuk = $request->tanggal_masuk ?? '2004-10-10';
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

        if ($karyawan) {
            return response()->json([
                'Profiles' => $karyawan,
                'message' => 'Data sukses ditambahkan!'
            ], 200);
        }
        else {
            return response()->json([
                'message' => 'Failed to create new data',
                'status' => 'failed',
                'code' => 400,
            ], 400);
        }
    }
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
        $validated = $request->validate([
            'nama_pegawai' => 'required|max:255',
            'nik'=> 'required',
            'alamat' => 'required|max:255',
            'no_telp' => 'required|max:14',
            'email' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'status_hubungan' => 'required|max:255',
            'agama' => 'required|max:255',
        ]);

        $karyawan = Karyawan::updateOrCreate(
            ['id' => $karyawan->id],
            [
                'nama_pegawai' => $request->nama_pegawai,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'status_hubungan' => $request->status_hubungan,
                'agama' => $request->agama,
                // 'foto' => $request->foto,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
                'lama_kerja' => $request->lama_kerja,
                'keterangan' => $request->keterangan,
                // rekening
                'nama_bank' => $request->nama_bank,
                'no_rekening' => $request->no_rekening,
                'atas_nama' => $request->atas_nama,
                //end rekening
            ]
        );
        if ($karyawan->wasChanged()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah!',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ada perubahan!',
            ], 400);
        }
    }

    public function updateStatuses(Request $request, $id)
    {
        $validated = $request->validate([
            'pegawai' => 'required|max:255',
        ]);

        $karyawan = Karyawan::updateOrCreate(
            ['id' => $id],
            [
                'pegawai' => $request->pegawai,
            ]
        );
        if ($karyawan->wasChanged()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah!',
                'data' => new KaryawanResource($karyawan),
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ada perubahan!',
                'data' => $karyawan
            ], 400);
        }
    }

    public function updateFoto(Request $request, $id)
    {
        $validated = $request->validate([
            'foto' => 'required|max:255',
        ]);

        $karyawan = Karyawan::findOrfail($id);
      
        if ($request->hasFile('foto')) {
            $karyawan->deleteFoto();
            $image = $request->file('foto');
            $name = rand(1000, 9999) . '.' . $image->getClientOriginalName();
            $image->move('images/foto_karyawan/', $name);
            $karyawan->foto = 'images/foto_karyawan/' . $name;
        }
        $karyawan->save();

        if ($karyawan->wasChanged()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah!',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ada perubahan!',
            ], 400);
        }

        // return response()->json([
        //     'data' => $karyawan,
        //     'message' => 'Data berhasil diubah! !'
        // ]);

    }

    public function updateBank(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_bank' => 'required|max:255',
            'no_rekening'=> 'required',
            'atas_nama' => 'required|max:255',
        ]);

        $karyawan = Karyawan::findOrfail($id);
        $karyawan->nama_bank = $request->nama_bank;
        $karyawan->no_rekening = $request->no_rekening;
        $karyawan->atas_nama = $request->atas_nama;
        $karyawan->save();

        return response()->json([
            'data' => $karyawan,
            'message' => 'Data berhasil diubah! !'
        ]);

    }

    public function updateGaji(Request $request, Karyawan $karyawan)
    {
       

        if($request->jabatan_id == 1) {
            $validator = Validator::make($request->all(), [
                'jabatan_id' => 'required|max:255',
                'status_id' => 'required|max:255', 
                
                'name' => 'required|max:255',
                'username' => 'required|max:15|unique:users',
                'email' => 'required|max:255|unique:karyawans|unique:users',
                'password' => 'required|string|min:8',
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $karyawan = Karyawan::updateOrCreate(
                ['id' => $karyawan->id],
                [
                'status_id' => $request->status_id,
                'jabatan_id' => $request->jabatan_id,
                ],
            );

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role ?? 'Human Resource Development',
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            if ($karyawan->wasChanged()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil diubah!',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ada perubahan!',
                ], 400);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'jabatan_id' => 'required|max:255',
                'status_id' => 'required|max:255', 
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $karyawan = Karyawan::updateOrCreate(
                ['id' => $karyawan->id],
                [
                'status_id' => $request->status_id,
                'jabatan_id' => $request->jabatan_id,
                ],
            );

            if ($karyawan->wasChanged()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil diubah!',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ada perubahan!',
                ], 400);
            }
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
        $karyawan = Karyawan::find($karyawan->id);
        $karyawan->delete();

        if ($karyawan) {
            return response()->json([
                'message' => 'Data ' . $karyawan->nama_pegawai . ' berhasil dihapus',
                'data' => $karyawan
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data ' . $karyawan->nama_pegawai . ' gagal dihapus',
                'data' => $karyawan
            ], 400);
        }
    }
    public function destroyAll(Karyawan $karyawan)
    {
        $karyawan = Karyawan::all()
            ->each(function ($karyawan) {
                $karyawan->delete();
            });
            $length = count($karyawan);

            if ($length > 0) {
                return response()->json([
                    'message' => 'Semua data berhasil dihapus',
                    'data' => $karyawan
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data tidak ada',
                    'data' => $karyawan
                ], 400);
            }
    }
}
