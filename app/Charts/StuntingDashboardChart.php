<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StuntingDashboardChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
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
            $stunting = DB::table('pemeriksaans')
                            ->where('stunting', 'positive')
                            ->whereYear('tgl_pemeriksaan', $tahun)
                            ->whereMonth('tgl_pemeriksaan', $i)
                            ->count('id_anak');
            $normal = DB::table('pemeriksaans')
                            ->where('stunting', 'negative')
                            ->whereYear('tgl_pemeriksaan', $tahun)
                            ->whereMonth('tgl_pemeriksaan', $i)
                            ->count('id_anak');
            $dataBulanP[] = $bulanName[$i];
            $dataStunting[] = $stunting;
            $dataNormal[] = $normal;
        }

        return $this->chart->lineChart()
            ->setTitle('Data Stunting')
            ->setSubtitle('Data Stunting di Kelurahan Cibaduyut')
            ->addData('Stunting', $dataStunting)
            ->addData('Sehat', $dataNormal)
            ->setXAxis($dataBulanP)
            ->setColors(['#FF0000', '#00B0FF']); 
    }
}
