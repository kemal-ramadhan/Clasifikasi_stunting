<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PertumbuhanChartLine
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($idAnak): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');

        $bulanName = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        for ($i=1; $i <= $bulan ; $i++) { 
            $beratbadan = DB::table('pemeriksaans')
                            ->where('id_anak', $idAnak)
                            ->whereYear('updated_at', $tahun)
                            ->whereMonth('updated_at', $i)
                            ->sum('berat_badan');
            $tinggiBadan = DB::table('pemeriksaans')
                            ->where('id_anak', $idAnak)
                            ->whereYear('updated_at', $tahun)
                            ->whereMonth('updated_at', $i)
                            ->sum('tinggi_badan');
            $lingkarKepala = DB::table('pemeriksaans')
                            ->where('id_anak', $idAnak)
                            ->whereYear('updated_at', $tahun)
                            ->whereMonth('updated_at', $i)
                            ->sum('lingkar_kepala');
            $dataBulanP[] = $bulanName[$i];
            $dataBB[] = $beratbadan; // Format pengeluaran dengan titik sebagai pemisah ribuan
            $dataLB[] = $tinggiBadan; // Format pengeluaran dengan titik sebagai pemisah ribuan
            $dataLK[] = $lingkarKepala; // Format pengeluaran dengan titik sebagai pemisah ribuan
        }

        return $this->chart->lineChart()
            ->setTitle('Perkembangan Anak')
            ->setSubtitle('Data Perkembangan Anak, Berat Badan, Tinggi Badan dan Lingkar Kepala')
            ->addData('Berat Badan', $dataBB)
            ->addData('Tinggi Badan', $dataLB)
            ->addData('Lingkar Kepala', $dataLK)
            ->setHeight(250)
            ->setXAxis($dataBulanP);
    }
}
