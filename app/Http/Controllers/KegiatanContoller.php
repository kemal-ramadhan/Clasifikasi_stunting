<?php


namespace App\Http\Controllers;
// require __DIR__ . '/../../../vendor/autoload.php';

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Dompdf\Dompdf;
use Dompdf\Options;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Phpml\Classification\NaiveBayes;
use Phpml\Dataset\ArrayDataset;

// use Phpml\Classification\SVM;
// use Phpml\SupportVectorMachine\Kernel;

use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

use App\Models\Posyandu;
use App\Models\Anak;
use App\Models\Antrian;
use App\Models\Kegiatan;
use App\Models\Training;

use App\Charts\PertumbuhanChartLine;
use App\Charts\Stunting;
use Illuminate\Support\Facades\Response;

class KegiatanContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexKegiatan()
    {
        $kegiatans = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->select('kegiatans.id', 'posyandus.nama_posyandu', 'kegiatans.nama_kegiatan', 'kegiatans.tgl_pelaksanaan', 'kegiatans.jam_pelaksanaan', 'kegiatans.status')
                ->orderBy('kegiatans.tgl_pelaksanaan', 'desc')
                ->get();
        return view('admin.kegiatan.kegiatan',[
            'title' => 'Data Kegiatan',
            'kegiatans' => $kegiatans,
            'posyandus' => Posyandu::all()
        ]);
    }
    
    public function editKegiatan($id)
    {
        $kegiatan = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->select('kegiatans.id', 'kegiatans.id_posyandu', 'posyandus.nama_posyandu', 'kegiatans.nama_kegiatan', 'kegiatans.tgl_pelaksanaan', 'kegiatans.jam_pelaksanaan', 'kegiatans.status')
                ->where('kegiatans.id', $id)
                ->first();
        return view('admin.kegiatan.editKegiatan',[
            'title' => 'Edit Data Kegiatan',
            'kegiatan' => $kegiatan,
            'posyandus' => Posyandu::all()
        ]);
    }
    
    public function indexPemeriksaan($id)
    {
        $pasien = DB::table('antrians')
                ->join('kegiatans', 'antrians.id_kegiatan', '=', 'kegiatans.id')
                ->join('anaks', 'antrians.id_anak', '=', 'anaks.id')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('antrians.id as idAntrian', 'kegiatans.id as idKegiatan', 'kegiatans.nama_kegiatan', 'antrians.no_urut', 'antrians.estimasi', 'anaks.id as idAnak', 'anaks.nama', 'ortus.nama as wali', 'antrians.status')
                ->where('antrians.id', $id)
                ->first();
        $anak = DB::table('anaks')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('anaks.id', 'ortus.id as idWali', 'ortus.nama as wali', 'anaks.nik', 'anaks.nama', 'anaks.jk', 'anaks.tempat_lahir', 'anaks.tanggal_lahir', 'anaks.keterangan', 'anaks.status')
                ->where('anaks.id', $pasien->idAnak)
                ->first();
        return view('admin.kegiatan.pemeriksaan',[
            'title' => 'Pemeriksaan',
            'antrian' => $pasien,
            'anak' => $anak
        ]);
    }
    
    public function indexReportAnak($id, PertumbuhanChartLine $chart)
    {
        $anak = DB::table('anaks')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('anaks.id', 'ortus.id as idWali', 'ortus.nama as wali', 'anaks.nik', 'anaks.nama', 'anaks.jk', 'anaks.tempat_lahir', 'anaks.tanggal_lahir', 'anaks.keterangan', 'anaks.status')
                ->where('anaks.id', $id)
                ->first();
        $hasilPemeriksaan = DB::table('pemeriksaans')
                ->join('kegiatans', 'pemeriksaans.id_kegiatan', '=', 'kegiatans.id')
                ->select('pemeriksaans.id as idPemeriksaan', 'pemeriksaans.tgl_pemeriksaan', 'kegiatans.nama_kegiatan', 'pemeriksaans.berat_badan', 'pemeriksaans.tinggi_badan', 'pemeriksaans.lingkar_kepala', 'pemeriksaans.vitamin', 'pemeriksaans.imunisasi', 'pemeriksaans.stunting', 'pemeriksaans.keterangan', 'pemeriksaans.status')
                ->where('pemeriksaans.id_anak', $id)
                ->orderBy('pemeriksaans.tgl_pemeriksaan', 'desc') // Menampilkan data terbaru berdasarkan tanggal pemeriksaan
                ->get();
        return view('admin.kegiatan.reportAnak',[
            'title' => 'Pemeriksaan',
            'anak' => $anak,
            'chartPertumbuhan' => $chart->build($id),
            'riwayats' => $hasilPemeriksaan
        ]);
    }
    
    public function detailReportAnak($id, Stunting $chart)
    {
        $pemeriksaan = DB::table('pemeriksaans')
                ->where('id', $id)
                ->first();
        $anak = DB::table('anaks')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('anaks.id', 'ortus.id as idWali', 'ortus.nama as wali', 'anaks.nik', 'anaks.nama', 'anaks.jk', 'anaks.tempat_lahir', 'anaks.tanggal_lahir', 'anaks.keterangan', 'anaks.status')
                ->where('anaks.id', $pemeriksaan->id_anak)
                ->first();
        
        // Metode Naive Bayes

        // koversi tanggal lahir ke bulan
        $tanggalLahir = new \DateTime($anak->tanggal_lahir);
        $sekarang = new \DateTime();

        // Hitung selisih bulan
        $interval = $tanggalLahir->diff($sekarang);
        $umurDalamBulan = ($interval->y * 12) + $interval->m;
        
        $umur = $umurDalamBulan;
        $bb = $pemeriksaan->berat_badan;
        $tb = $pemeriksaan->tinggi_badan;
        $lla = $pemeriksaan->lingkar_kepala;

        $dataTraining = DB::table('trainings')->get(); // mengambil data dari table training

        // Mengelompokkan atribut dan label dari data latih
        $samples = [];
        $labels = [];
        foreach ($dataTraining as $data) {
            $samples[] = [$data->umur, $data->berat_badan, $data->tinggi_badan, $data->lingkar_atas];
            $labels[] = $data->status;
        }

        $trainingData = Training::all();
        $totalData = $trainingData->count();

        $statusAbsence = Training::where('status', 'absence')->count();
        $statusPresence = Training::where('status', 'presence')->count();

        $peluangStatusAbsence = $statusAbsence / $totalData;
        $peluangStatusPresence = $statusPresence / $totalData;

        // menghitung atribut umur

        if($umur >= 0 && $umur < 25)
        {
            $umurCat = Training::where('umur', '>=', 0)
                ->where('umur', '<', 25)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        elseif($umur >= 25 && $umur < 49)
        {
            $umurCat = Training::where('umur', '>=', 25)
                ->where('umur', '<', 49)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        else
        {
            $umurCat = Training::where('umur', '>=', 49)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }

        // Nilai Peluang Umur
        $peluangAbsenceUmur = isset($umurCat['absence']) ? $umurCat['absence'] / $statusAbsence : 0;
        $peluangPresenceUmur = isset($umurCat['presence']) ? $umurCat['presence'] / $statusPresence : 0;

        // menghitung Berat Badan
        if ($bb >= 0 && $bb < 6)
        {
            $bbCat = Training::where('berat_badan', '>=', 0)
                ->where('berat_badan', '<', 6)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        elseif ($bb >= 6 && $bb < 11)
        {
            $bbCat = Training::where('berat_badan', '>=', 6)
                ->where('berat_badan', '<', 11)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        elseif ($bb >= 11 && $bb < 16)
        {
            $bbCat = Training::where('berat_badan', '>=', 11)
                ->where('berat_badan', '<', 16)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        elseif ($bb >= 16 && $bb < 21)
        {
            $bbCat = Training::where('berat_badan', '>=', 16)
                ->where('berat_badan', '<', 21)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        else
        {
            $bbCat = Training::where('berat_badan', '>=', 21)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }

        // Nilai Peluang Berat Badan
        $peluangAbsenceBb = isset($bbCat['absence']) ? $bbCat['absence'] / $statusAbsence : 0;
        $peluangPresenceBb = isset($bbCat['presence']) ? $bbCat['presence'] / $statusPresence : 0;

        //menghitung Tinggi Badan
        if($tb >= 0 && $tb < 26)
        {
            $tbCat = Training::where('tinggi_badan', '>=', 0)
                ->where('tinggi_badan', '<', 26)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        elseif($tb >=26 && $tb < 51)
        {
            $tbCat = Training::where('tinggi_badan', '>=', 26)
                ->where('tinggi_badan', '<', 51)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        elseif($tb >= 51 && $tb < 76)
        {
            $tbCat = Training::where('tinggi_badan', '>=', 51)
                ->where('tinggi_badan', '<', 76)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        elseif($tb >= 76 && $tb < 100)
        {
            $tbCat = Training::where('tinggi_badan', '>=', 76)
                ->where('tinggi_badan', '<', 100)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        else
        {
            $tbCat = Training::where('tinggi_badan', '>=', 100)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }

        // Nilai Peluang Berat Badan
        $peluangAbsenceTb = isset($tbCat['absence']) ? $tbCat['absence'] / $statusAbsence : 0;
        $peluangPresenceTb = isset($tbCat['presence']) ? $tbCat['presence'] / $statusPresence : 0;

        // menghitung Lingkar Atas
        if($lla >= 0 && $lla < 16)
        {
            $llaCat = Training::where('lingkar_atas', '>=', 0)
                ->where('lingkar_atas', '<', 16)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }
        else
        {
            $llaCat = Training::where('lingkar_atas', '>=', 16)
                ->whereIn('status', ['absence', 'presence'])
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
        }

        // Nilai Peluang Lingkar Atas
        $peluangAbsenceLla = isset($llaCat['absence']) ? $llaCat['absence'] / $statusAbsence : 0;
        $peluangPresenceLla = isset($llaCat['presence']) ? $llaCat['presence'] / $statusPresence : 0;

        $nilaiAbsence = ($peluangAbsenceUmur * $peluangAbsenceBb * $peluangAbsenceTb * $peluangAbsenceLla) * $peluangStatusAbsence;
        $nilaiPresence = ($peluangPresenceUmur * $peluangPresenceBb * $peluangPresenceTb * $peluangPresenceLla) * $peluangStatusPresence;

        if($nilaiAbsence > $nilaiPresence)
        {
            $predicted = 'absence';
        }
        else
        {
            $predicted = 'presence';
        }

        // end Metode Naive Bayes
        return view('admin.kegiatan.detailReportAnak',[
            'title' => 'Detail Pemeriksaan',
            'anak' => $anak,
            'hasil' => $pemeriksaan,
            'predicted' => $predicted,
            'nilaiAbsence' => $nilaiAbsence,
            'nilaiPresence' => $nilaiPresence,
            'chartStunting' => $chart->build($nilaiAbsence, $nilaiPresence),
            'umurbulan' => $umur,
        ]);
    }
    
    public function detailKegiatan($id)
    {
        $kegiatan = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->select('kegiatans.id', 'kegiatans.id_posyandu', 'posyandus.nama_posyandu', 'kegiatans.nama_kegiatan', 'kegiatans.tgl_pelaksanaan', 'kegiatans.status')
                ->where('kegiatans.id', $id)
                ->first();
        
        $antrians = DB::table('antrians')
                ->join('anaks', 'antrians.id_anak', '=', 'anaks.id')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('antrians.id as idAntrian', 'antrians.no_urut', 'antrians.estimasi', 'anaks.nama', 'anaks.id as idAnak', 'ortus.nama as wali', 'antrians.status')
                ->where('antrians.id_kegiatan', $id)
                ->get();
        return view('admin.kegiatan.detailKegiatan',[
            'title' => 'Kegiatan',
            'kegiatan' => $kegiatan,
            'anaks' => Anak::all(),
            'antrians' => $antrians
        ]);
    }
    
    public function indexRiwayat()
    {
        $kegiatans = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->select('kegiatans.id', 'posyandus.nama_posyandu', 'kegiatans.nama_kegiatan', 'kegiatans.tgl_pelaksanaan', 'kegiatans.jam_pelaksanaan', 'kegiatans.status')
                ->orderBy('kegiatans.tgl_pelaksanaan', 'desc')
                ->where('kegiatans.status', 'selesai')
                ->get();
        return view('admin.kegiatan.riwayat',[
            'title' => 'Riwayat Kegiatan',
            'kegiatans' => $kegiatans,
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
    public function storeKegiatan(Request $request)
    {
        DB::table('kegiatans')->insertOrIgnore([
            'id_posyandu' => $request->posyandu,
            'nama_kegiatan' => $request->kegiatan,
            'tgl_pelaksanaan' => $request->pelaksanaan,
            'jam_pelaksanaan' => $request->jam,
            'status' => 'Akan Datang',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('kegiatan')->with('success', 'Data Berhasil Ditambahkan!');
    }
     
    public function storeAntrian(Request $request)
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
            'id_anak' => $request->anak,
            'no_urut' => $nomor_urut,
            'estimasi' => $estimasi,
            'status' => 'Menunggu Antrian',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('detailKegiatan', ['id' => $request->idKegiatan])->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function storePemeriksaan(Request $request)
    {
        DB::table('pemeriksaans')->insertOrIgnore([
            'id_kegiatan' => $request->idKegiatan,
            'id_anak' => $request->idAnak,
            'berat_badan' => $request->bb,
            'tinggi_badan' => $request->tb,
            'lingkar_kepala' => $request->lk,
            'vitamin' => $request->vitamin,
            'imunisasi' => $request->imunisasi,
            'tgl_pemeriksaan' => now(),
            'keterangan' => $request->keterangan,
            'status' => 'Selesai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('antrians')
            ->where('id', $request->idAntrian)
            ->update([
                'status' => 'Selesai',
                'updated_at' => now(),
            ]);

        return redirect()->route('reportAnak', ['id' => $request->idAnak])->with('success', 'Data Berhasil Disimpan dan Diproses!');
    }
    
    /**
     * Display the specified resource.
     */
    public function showDetailRiwayat(string $id)
    {
        $riwayats = DB::table('pemeriksaans')
                ->join('anaks', 'pemeriksaans.id_anak', '=', 'anaks.id')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('pemeriksaans.tgl_pemeriksaan', 'ortus.nama as wali', 'anaks.nama', 'anaks.jk', 'anaks.tanggal_lahir', 'pemeriksaans.berat_badan', 'pemeriksaans.tinggi_badan', 'pemeriksaans.lingkar_kepala', 'pemeriksaans.vitamin', 'pemeriksaans.imunisasi', 'pemeriksaans.stunting', 'pemeriksaans.keterangan')
                ->where('pemeriksaans.id_kegiatan', $id)
                ->get();
        $lokasi = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->join('puskesmas', 'posyandus.id_puskesmas', '=', 'puskesmas.id')
                ->select('puskesmas.nama_puskesmas', 'posyandus.nama_posyandu', 'kegiatans.status')
                ->where('kegiatans.id', $id)
                ->first();
        return view('admin.kegiatan.detailRiwayat',[
            'title' => 'Riwayat Kegiatan',
            'kegiatan' => Kegiatan::find($id),
            'lokasi' => $lokasi,
            'riwayats' => $riwayats,
            'countPeserta' => $riwayats->count(),
            'countNegative' => $riwayats->where('stunting', 'negative')->count(),
            'countPositive' => $riwayats->where('stunting', 'positive')->count(),
        ]);
    }
    
    public function exportPdf(Request $request)
    {
        $action = $request->input('aksi');

        if ($action == 'exportExcel') {
            $riwayats = DB::table('pemeriksaans')
                ->join('anaks', 'pemeriksaans.id_anak', '=', 'anaks.id')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('pemeriksaans.tgl_pemeriksaan', 'ortus.nama as wali', 'anaks.nama', 'anaks.jk', 'anaks.tanggal_lahir', 'pemeriksaans.berat_badan', 'pemeriksaans.tinggi_badan', 'pemeriksaans.lingkar_kepala', 'pemeriksaans.vitamin', 'pemeriksaans.imunisasi', 'pemeriksaans.stunting', 'pemeriksaans.keterangan')
                ->where('pemeriksaans.id_kegiatan', $request->idRiwayat)
                ->get();
            // Inisialisasi objek Spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Header kolom
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Tanggal Pemeriksaan');
            $sheet->setCellValue('C1', 'Nama Orang Tua');
            $sheet->setCellValue('D1', 'Nama Anak');
            $sheet->setCellValue('E1', 'Jenis Kelamin');
            $sheet->setCellValue('F1', 'Tanggal Lahir');
            $sheet->setCellValue('G1', 'Usia Anak');
            $sheet->setCellValue('H1', 'BB');
            $sheet->setCellValue('I1', 'TB');
            $sheet->setCellValue('J1', 'LK');
            $sheet->setCellValue('K1', 'Vitamin');
            $sheet->setCellValue('L1', 'Imunisasi');
            $sheet->setCellValue('M1', 'Status Stunting');
            $sheet->setCellValue('N1', 'Keterangan');

            // Menulis data pengguna ke sel-sel berikutnya
            $row = 2;
            foreach ($riwayats as $index => $riwayat) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $riwayat->tgl_pemeriksaan);
                $sheet->setCellValue('C' . $row, $riwayat->wali);
                $sheet->setCellValue('D' . $row, $riwayat->nama);
                $sheet->setCellValue('E' . $row, $riwayat->jk);
                // Menulis tanggal lahir terlebih dahulu
                $sheet->setCellValue('F' . $row, $riwayat->tanggal_lahir);
                // Menulis formula untuk menghitung umur
                $sheet->setCellValue('G' . $row, '=DATEDIF(F' . $row . ', TODAY(), "Y")');
                $sheet->setCellValue('H' . $row, $riwayat->berat_badan);
                $sheet->setCellValue('I' . $row, $riwayat->tinggi_badan);
                $sheet->setCellValue('J' . $row, $riwayat->lingkar_kepala);
                $sheet->setCellValue('K' . $row, $riwayat->vitamin);
                $sheet->setCellValue('L' . $row, $riwayat->imunisasi);
                $sheet->setCellValue('M' . $row, $riwayat->stunting);
                $sheet->setCellValue('N' . $row, $riwayat->keterangan);
                $row++;
            }

            // Membuat objek Writer dan menyimpan spreadsheet ke file Excel
            $writer = new Xlsx($spreadsheet);
            $filename = 'Laporan Riwayat Kegiatan ' . $request->kegiatan . '-' . time() . '.xlsx'; // Nama file Excel yang akan disimpan
            // Membuat response dan mengirimkan file Excel ke browser
            return Response::streamDownload(function () use ($writer) {
                $writer->save('php://output');
            }, $filename);
        }

        if ($action == 'exportPdf') {
            $riwayats = DB::table('pemeriksaans')
                ->join('anaks', 'pemeriksaans.id_anak', '=', 'anaks.id')
                ->join('ortus', 'anaks.id_ortu', '=', 'ortus.id')
                ->select('pemeriksaans.tgl_pemeriksaan', 'ortus.nama as wali', 'anaks.nama', 'anaks.jk', 'anaks.tanggal_lahir', 'pemeriksaans.berat_badan', 'pemeriksaans.tinggi_badan', 'pemeriksaans.lingkar_kepala', 'pemeriksaans.vitamin', 'pemeriksaans.imunisasi', 'pemeriksaans.stunting', 'pemeriksaans.keterangan')
                ->where('pemeriksaans.id_kegiatan', $request->idRiwayat)
                ->get();
            $lokasi = DB::table('kegiatans')
                ->join('posyandus', 'kegiatans.id_posyandu', '=', 'posyandus.id')
                ->join('puskesmas', 'posyandus.id_puskesmas', '=', 'puskesmas.id')
                ->select('puskesmas.nama_puskesmas', 'posyandus.nama_posyandu', 'kegiatans.status')
                ->where('kegiatans.id', $request->idRiwayat)
                ->first();

            // Buat objek Dompdf baru
            $dompdf = new Dompdf();

            // Set opsi tambahan jika diperlukan
            $options = new Options();
            // $options->set('defaultFont', 'Courier'); // Contoh: mengatur font default (opsional)
            $dompdf->setOptions($options);

            // Render view menjadi HTML dengan data pengguna
            $html = view('export.pdf', [
                'title' => 'Riwayat Kegiatan',
                'kegiatan' => Kegiatan::find($request->idRiwayat),
                'lokasi' => $lokasi,
                'riwayats' => $riwayats,
                'countPeserta' => $riwayats->count(),
                'countNegative' => $riwayats->where('stunting', 'negative')->count(),
                'countPositive' => $riwayats->where('stunting', 'positive')->count(),
            ])->render();

            // Muat HTML ke Dompdf
            $dompdf->loadHtml($html);

            // Set ukuran dan orientasi kertas (A4 dan landscape)
            $dompdf->setPaper('A4', 'landscape');

            // Render PDF
            $dompdf->render();

            return $dompdf->stream('Laporan Riwayat Kegiatan ' . $request->kegiatan . '-' . time());
        }
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
    public function updateKegiatan(Request $request)
    {
        DB::table('kegiatans')
            ->where('id', $request->idKegiatan)
            ->update([
                'id_posyandu' => $request->posyandu,
                'nama_kegiatan' => $request->kegiatan,
                'tgl_pelaksanaan' => $request->pelaksanaan,
                'jam_pelaksanaan' => $request->jam,
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('editKegiatan', ['id' => $request->idKegiatan])->with('success', 'Data Berhasil Diperbaharui!');
  
    }

    public function UpdatePemeriksaan(Request $request)
    {
        DB::table('pemeriksaans')
            ->where('id', $request->idPemriksaan)
            ->update([
                'berat_badan' => $request->bb,
                'tinggi_badan' => $request->tb,
                'lingkar_kepala' => $request->lk,
                'vitamin' => $request->vitamin,
                'imunisasi' => $request->imunisasi,
                'stunting' => $request->stunting,
                'keterangan' => $request->keterangan,
                'updated_at' => now(),
            ]);

        return redirect()->route('reportAnak', ['id' => $request->idAnak])->with('success', 'Data Berhasil Diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    }
}
