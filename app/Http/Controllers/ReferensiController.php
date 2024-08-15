<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Puskesmas;
use App\Models\Posyandu;
use App\Models\KeluargaBerenca;
use App\Models\Ortu;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ReferensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    public function indexPuskesmas()
    {
        return view('admin.referensi.tempatPuskesmas',[
            'title' => 'Data Referensi Puskesmas',
            'puskesmass' =>  Puskesmas::all(),
        ]);
    }
    
    public function indexPosyandu()
    {
        $datas = DB::table('posyandus')
                ->join('puskesmas', 'posyandus.id_puskesmas', '=', 'puskesmas.id')
                ->select('posyandus.id', 'puskesmas.nama_puskesmas', 'posyandus.nama_posyandu', 'posyandus.alamat', 'posyandus.rw', 'posyandus.status')
                ->get();
        return view('admin.referensi.tempatPosyandu',[
            'title' => 'Data Referensi Posyandu',
            'posyandus' =>  $datas,
            'puskesmass' => Puskesmas::all(),
        ]);
    }

    public function indexKelurahan()
    {
        $peapole = DB::table('petugas')
                ->where('role', 'Kelurahan')
                ->get();
        return view('admin.referensi.refPetugas',[
            'title' => 'Data Referensi Kelurahan',
            'headline' => 'Data Personal Kelurahan',
            'role' => 'Kelurahan',
            'peapoles' =>  $peapole,
        ]);
    }
    
    public function indexPuskesmasPerson()
    {
        $peapole = DB::table('petugas')
                ->where('role', 'Petugas Puskesmas')
                ->get();
        return view('admin.referensi.refPetugas',[
            'title' => 'Data Referensi Puskesmas',
            'headline' => 'Data Personal Puskesmas',
            'role' => 'Petugas Puskesmas',
            'peapoles' =>  $peapole,
        ]);
    }
    
    public function indexKaderPerson()
    {
        $peapole = DB::table('petugas')
                ->where('role', 'Kader')
                ->get();
        return view('admin.referensi.refPetugas',[
            'title' => 'Data Referensi Kader',
            'headline' => 'Data Personal Kader',
            'role' => 'Kader',
            'peapoles' =>  $peapole,
        ]);
    }
    
    public function indexKb()
    {
        return view('admin.referensi.kb',[
            'title' => 'Data Referensi Pill Keluarag Berencana(KB)',
            'kbs' => KeluargaBerenca::all(),
        ]);
    }
    
    public function indexOrtu()
    {
        $ortus = DB::table('ortus')
                ->select('ortus.id', 'ortus.NIK', 'ortus.nama', 'ortus.alamat', 'ortus.email', 'ortus.no_telp', 'ortus.username', 'ortus.status')
                ->get();
        return view('admin.referensi.ortu',[
            'title' => 'Data Referensi Orang Tua',
            'kbs' => KeluargaBerenca::all(),
            'ortus' => $ortus,
        ]);
    }
    
    public function indexAnak()
    {
        $anaks = DB::table('anaks')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('anaks.id', 'ortus.nama as wali', 'anaks.nik', 'anaks.nama', 'anaks.jk', 'anaks.tempat_lahir', 'anaks.tanggal_lahir', 'anaks.keterangan', 'anaks.status')
                ->get();
        return view('admin.referensi.anak',[
            'title' => 'Data Referensi Anak',
            'anaks' => $anaks,
            'ortus' => Ortu::all()
        ]);
    }
    
    public function DetailPetugas($id)
    {
        return view('admin.referensi.detail',[
            'title' => 'Detail Data Referensi',
            'person' => Petugas::find($id),
            'puskemass' => Puskesmas::all(),
            'posyandus' => Posyandu::all()
        ]);
    }
    
    public function detailPuskesmas($id)
    {
        $datas = DB::table('posyandus')
                ->join('puskesmas', 'posyandus.id_puskesmas', '=', 'puskesmas.id')
                ->select('posyandus.id', 'puskesmas.nama_puskesmas', 'puskesmas.id', 'posyandus.nama_posyandu', 'posyandus.alamat', 'posyandus.rw', 'posyandus.status')
                ->where('puskesmas.id', $id)
                ->get();
        return view('admin.referensi.detailPuskesmas',[
            'title' => 'Detail Data Pusesmas',
            'puskesmas' => Puskesmas::find($id),
            'posyandus' =>  $datas,
        ]);
    }
    
    public function detailPosyandu($id)
    {
        $peapole = DB::table('petugas')
                ->where('id_posyandu', $id)
                ->get();
        return view('admin.referensi.detailPosyandu',[
            'title' => 'Detail Data Posyandu',
            'posyandu' => Posyandu::find($id),
            'puskesmass' => Puskesmas::all(),
            'peapoles' =>  $peapole,
        ]);
    }
    
    public function detailKb($id)
    {
        return view('admin.referensi.detailKb',[
            'title' => 'Detail Data Keluarga Berencana (KB)',
            'kb' => KeluargaBerenca::find($id),
        ]);
    }
    
    public function detailOrtu($id)
    {
        $anaks = DB::table('anaks')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('anaks.id', 'ortus.nama as wali', 'anaks.nik', 'anaks.nama', 'anaks.jk', 'anaks.tempat_lahir', 'anaks.tanggal_lahir', 'anaks.keterangan', 'anaks.status')
                ->where('anaks.id_ortu', $id)
                ->get();
        return view('admin.referensi.detailOrtu',[
            'title' => 'Detail Data Orang Tua',
            'kbs' => KeluargaBerenca::all(),
            'anaks' => $anaks,
            'ortu' => Ortu::find($id),
        ]);
    }
    
    public function detailAnak($id)
    {
        $anak = DB::table('anaks')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('anaks.id', 'ortus.id as idWali', 'ortus.nama as wali', 'anaks.nik', 'anaks.nama', 'anaks.jk', 'anaks.tempat_lahir', 'anaks.tanggal_lahir', 'anaks.keterangan', 'anaks.status')
                ->where('anaks.id', $id)
                ->first();
        return view('admin.referensi.detailAnak',[
            'title' => 'Detail Data Anak',
            'anak' => $anak,
            'ortus' => Ortu::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function storePetugas(Request $request)
    {
        DB::table('petugas')->insertOrIgnore([
            'nama' => $request->nama,
            'jk' => $request->jk,
            'jabatan' => $request->jabatan,
            'role' => $request->role,
            'email' => $request->email,
            'no_tlp' => $request->noTelp,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->role == 'Kelurahan') {
            return redirect()->route('refKelurahan')->with('success', 'Data Berhasil Ditambahkan!');
        }
        if ($request->role == 'Puskesmas') {
            return redirect()->route('refPuskesmas')->with('success', 'Data Berhasil Ditambahkan!');
        }
        if ($request->role == 'Kader') {
            return redirect()->route('refKader')->with('success', 'Data Berhasil Ditambahkan!');
        }

    }
    
    public function storePuskesmas(Request $request)
    {
        DB::table('puskesmas')->insertOrIgnore([
            'nama_puskesmas' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('refTempatPuskesmas')->with('success', 'Data Berhasil Ditambahkan!');

    }
    
    public function storePosyandu(Request $request)
    {
        DB::table('posyandus')->insertOrIgnore([
            'id_puskesmas' => $request->puskesmas,
            'nama_posyandu' => $request->nama,
            'alamat' => $request->alamat,
            'rw' => $request->rw,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('refPosyandu')->with('success', 'Data Berhasil Ditambahkan!');

    }
    
    public function storeKb(Request $request)
    {
        DB::table('keluarga_berencas')->insertOrIgnore([
            'nama_kb' => $request->kb,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('refKb')->with('success', 'Data Berhasil Ditambahkan!');

    }
    
    public function storeOrtu(Request $request)
    {
        DB::table('ortus')->insertOrIgnore([
            'id_kb' => $request->kb,
            'NIK' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telp' => $request->notelp,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('refOrtu')->with('success', 'Data Berhasil Ditambahkan!');

    }
    
    public function storeAnak(Request $request)
    {
        DB::table('anaks')->insertOrIgnore([
            'id_ortu' => $request->wali,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tgl,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('refAnak')->with('success', 'Data Berhasil Ditambahkan!');

    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    
    public function updatePerson(Request $request)
    {

        DB::table('petugas')
            ->where('id', $request->idPerson)
            ->update([
                'id_puskesmas' => $request->puskesmas,
                'id_posyandu' => $request->posyandu,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'jabatan' => $request->jabatan,
                'role' => $request->role,
                'email' => $request->email,
                'no_tlp' => $request->noTelp,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('detailPetugas', ['id' => $request->idPerson])->with('success', 'Data Berhasil Diperbaharui!');
  
    }
    
    public function updatePuskesmas(Request $request)
    {

        DB::table('puskesmas')
            ->where('id', $request->idPuskesmas)
            ->update([
                'nama_puskesmas' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('refDetailPuskesmas', ['id' => $request->idPuskesmas])->with('success', 'Data Berhasil Diperbaharui!');
  
    }
    
    public function updatePosyandu(Request $request)
    {

        DB::table('posyandus')
            ->where('id', $request->idPosyandu)
            ->update([
                'id_puskesmas' => $request->puskesmas,
                'nama_posyandu' => $request->nama,
                'alamat' => $request->alamat,
                'rw' => $request->rw,
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('refDetailPosyandu', ['id' => $request->idPosyandu])->with('success', 'Data Berhasil Diperbaharui!');
  
    }
    
    public function updateKb(Request $request)
    {

        DB::table('keluarga_berencas')
            ->where('id', $request->idKb)
            ->update([
                'nama_kb' => $request->kb,
                'keterangan' => $request->keterangan,
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('refDetailKb', ['id' => $request->idKb])->with('success', 'Data Berhasil Diperbaharui!');
  
    }
    
    public function updateOrtu(Request $request)
    {

        DB::table('ortus')
            ->where('id', $request->idOrtu)
            ->update([
                'id_kb' => $request->kb,
                'NIK' => $request->nik,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_telp' => $request->notelp,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('refDetailOrtu', ['id' => $request->idOrtu])->with('success', 'Data Berhasil Diperbaharui!');
  
    }
    
    public function updateAnak(Request $request)
    {

        DB::table('anaks')
            ->where('id', $request->idAnak)
            ->update([
                'id_ortu' => $request->wali,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tgl,
                'keterangan' => $request->keterangan,
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('refDetailAnak', ['id' => $request->idAnak])->with('success', 'Data Berhasil Diperbaharui!');
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
