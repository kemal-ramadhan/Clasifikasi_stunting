<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Models\Anak;
use App\Models\Antrian;
use App\Models\Kegiatan;
use App\Models\Edukasi;
use App\Models\KeluargaBerenca;

use App\Charts\PertumbuhanChartLine;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function authenticate(Request $request)
    {
        $credit = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('ortu')->attempt($credit)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
 
        return back()->with('LoginError', 'Akses Masuk Salah, Periksa lagi akses masuknya!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/')->with('LoginError', 'Logout Success!');
    }

    public function index()
    {
        return view('akses.loginpublic');
    }
    
    public function indexDaftarAkun()
    {
        return view('akses.daftar');
    }
    
    public function indexHome()
    {
        $kegiatans = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->select('kegiatans.id', 'posyandus.nama_posyandu', 'kegiatans.nama_kegiatan', 'kegiatans.tgl_pelaksanaan', 'kegiatans.jam_pelaksanaan', 'kegiatans.status')
                ->orderBy('kegiatans.tgl_pelaksanaan', 'desc')
                ->get();
        return view('user.home', [
            'title' => 'Beranda',
            'kegiatans' => $kegiatans,
        ]);
    }
    
    public function indexKegiatan()
    {
        $kegiatans = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->select('kegiatans.id', 'posyandus.nama_posyandu', 'kegiatans.nama_kegiatan', 'kegiatans.tgl_pelaksanaan', 'kegiatans.jam_pelaksanaan', 'kegiatans.status')
                ->orderBy('kegiatans.tgl_pelaksanaan', 'desc')
                ->get();
        return view('user.kegiatan', [
            'title' => 'Kegiatan',
            'kegiatans' => $kegiatans,
        ]);
    }
    
    public function indexDetailKegiatan($id)
    {
        $kegiatan = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->select('kegiatans.id', 'posyandus.nama_posyandu', 'kegiatans.nama_kegiatan', 'kegiatans.tgl_pelaksanaan', 'kegiatans.jam_pelaksanaan', 'kegiatans.status')
                ->orderBy('kegiatans.tgl_pelaksanaan', 'desc')
                ->where('kegiatans.id', $id)
                ->first();
        $antrian = Antrian::where('id_kegiatan', $id)->get();
        return view('user.detailKegiatan', [
            'title' => 'Detail Kegiatan',
            'kegiatan' => $kegiatan,
            'anaks' => Anak::where('id_ortu', auth('ortu')->user()->id)->get(),
            'antrians' => $antrian,
        ]);
    }
        
    public function indexDetailPemeriksaan($idAnak, $idKegiatan)
    {
        $kegiatan = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->select('kegiatans.id', 'posyandus.nama_posyandu', 'kegiatans.nama_kegiatan', 'kegiatans.tgl_pelaksanaan', 'kegiatans.jam_pelaksanaan', 'kegiatans.status')
                ->orderBy('kegiatans.tgl_pelaksanaan', 'desc')
                ->where('kegiatans.id', $idKegiatan)
                ->first();
        $pemeriksaan = DB::table('pemeriksaans')
                ->join('anaks', 'pemeriksaans.id_anak', '=', 'anaks.id')
                ->select('pemeriksaans.tgl_pemeriksaan', 'anaks.nama', 'pemeriksaans.berat_badan', 'pemeriksaans.tinggi_badan', 'pemeriksaans.lingkar_kepala', 'pemeriksaans.vitamin', 'pemeriksaans.imunisasi', 'pemeriksaans.stunting', 'pemeriksaans.keterangan')
                ->where('pemeriksaans.id_kegiatan', $idKegiatan)
                ->where('pemeriksaans.id_anak', $idAnak)
                ->first();
        return view('user.detailPemeriksaan', [
            'title' => 'Detail Kegiatan Pemeriksaan',
            'kegiatan' => $kegiatan,
            'anak' => Anak::find($idAnak),
            'pemeriksaan' => $pemeriksaan,
        ]);
    }

    public function indexPerkembangan()
    {
        return view('user.anaks', [
            'title' => 'Perkembangan Anak',
            'anaks' => Anak::where('id_ortu', auth('ortu')->user()->id)->get(),
        ]);
    }
    
    public function indexDetailPerkembangan($id, PertumbuhanChartLine $chart)
    {
        $hasilPemeriksaan = DB::table('pemeriksaans')
                ->join('kegiatans', 'pemeriksaans.id_kegiatan', '=', 'kegiatans.id')
                ->select('pemeriksaans.id as idPemeriksaan', 'pemeriksaans.tgl_pemeriksaan', 'kegiatans.nama_kegiatan', 'pemeriksaans.berat_badan', 'pemeriksaans.tinggi_badan', 'pemeriksaans.lingkar_kepala', 'pemeriksaans.vitamin', 'pemeriksaans.imunisasi', 'pemeriksaans.stunting', 'pemeriksaans.keterangan', 'pemeriksaans.status')
                ->where('pemeriksaans.id_anak', $id)
                ->orderBy('pemeriksaans.tgl_pemeriksaan', 'desc') // Menampilkan data terbaru berdasarkan tanggal pemeriksaan
                ->get();
        return view('user.perkembangan', [
            'title' => 'Perkembangan Anak',
            'anak' => Anak::find($id),
            'chartPertumbuhan' => $chart->build($id),
            'riwayats' => $hasilPemeriksaan,
        ]);
    }
    
    public function indexEdukasi()
    {
        return view('user.edukasi', [
            'title' => 'Edukasi Kesehatan',
            'edukasis' => Edukasi::all(),
        ]);
    }
    
    public function indexProfile()
    {
        $anaks = DB::table('anaks')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('anaks.id', 'ortus.nama as wali', 'anaks.nik', 'anaks.nama', 'anaks.jk', 'anaks.tempat_lahir', 'anaks.tanggal_lahir', 'anaks.keterangan', 'anaks.status')
                ->where('anaks.id_ortu', auth('ortu')->user()->id)
                ->get();
        return view('user.profile', [
            'title' => 'My Profile',
            'anaks' => $anaks,
            'kbs' => KeluargaBerenca::all(),
        ]);
    }
    
    public function indexDetailAnak($id)
    {
        return view('user.detailAnak', [
            'title' => 'My Profile, Detail Anak',
            'anak' => Anak::find($id),
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
    public function storePengguna(Request $request)
    {
        DB::table('ortus')->insertOrIgnore([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/')->with('LoginError', 'Pendaftaran Berhasil, Silahkan Masuk dan Isi data yang kurang pada bagian profile!');
    }

    public function storeAntrian(string $id, Request $request)
    {
        $lastAntrian = Antrian::where('id_kegiatan', $request->idKegiatan)->latest()->first();
        $jamMulai = Kegiatan::where('id', $request->idKegiatan)->latest()->first();

        if ($lastAntrian) {
            // Jika ada nomor antrian sebelumnya
            $nomor_urut = $lastAntrian->no_urut + 1;
            // Menghitung estimasi kedatangan
            $estimasi = date('H:i:s', strtotime($lastAntrian->estimasi) + 180);
            // $estimasi = $jamMulai->jam_pelaksanaan;
        } else {
            // Jika tidak ada nomor antrian sebelumnya
            $nomor_urut = 1;
            // Menggunakan jam pelaksanaan sebagai estimasi kedatangan
            $estimasi = $jamMulai->jam_pelaksanaan;
        }

        // ddd($estimasi);

        DB::table('antrians')->insertOrIgnore([
            'id_kegiatan' => $request->idKegiatan,
            'id_anak' => $id,
            'no_urut' => $nomor_urut,
            'estimasi' => $estimasi,
            'status' => 'Menunggu Antrian',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('detailKegiatanPubic', ['id' => $request->idKegiatan])->with('success', 'Data Berhasil Ditambahkan!');
    }
    
    public function storeAnak(Request $request)
    {
        DB::table('anaks')->insertOrIgnore([
            'id_ortu' => auth('ortu')->user()->id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tgl,
            'keterangan' => $request->keterangan,
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('perkembangan')->with('success', 'Data Berhasil Ditambahkan!');
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
    public function updateProfile(Request $request)
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
                'updated_at' => now(),
            ]);

        return redirect()->route('profile')->with('success', 'Data Berhasil Diperbaharui!');
    }
    
    public function updateAnak(Request $request)
    {
        DB::table('anaks')
            ->where('id', $request->idAnak)
            ->update([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tgl,
                'keterangan' => $request->keterangan,
                'updated_at' => now(),
            ]);

        return redirect()->route('profile')->with('success', 'Data Berhasil Diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
