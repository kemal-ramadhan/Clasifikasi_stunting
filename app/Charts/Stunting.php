<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class Stunting
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($nilaiAbsence, $nilaiPresence): \ArielMejiaDev\LarapexCharts\HorizontalBar
    {
        return $this->chart->horizontalBarChart()
            ->setTitle('Nilai Perhitungan Sistem')
            ->setSubtitle('Perhitungan Menggunakan Naive Bayes')
            ->setColors(['#63AC45', '#D32F2F'])
            ->addData('Tidak Beresiko', [$nilaiAbsence])
            ->addData('Beresiko Stunting', [$nilaiPresence])
            ->setXAxis(['Kategori']); // Label 
    }
}
