<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            font-size: 8px; /* Ukuran font dasar lebih kecil */
        }
        .container {
            width: 100%;
            margin: auto;
            padding: 10px;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 20px; /* Ukuran font judul lebih kecil */
            margin-bottom: 10px;
            color: #000000;
        }
        .header p {
            font-size: 12px; /* Ukuran font paragraf header lebih kecil */
            margin-bottom: 0;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 0.5rem; /* Ukuran font tabel lebih kecil */
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px; /* Mengurangi padding untuk menghemat ruang */
            text-align: left;
            font-size: 10px; /* Ukuran font sel lebih kecil */
            color: #333;
        }
        th {
            background-color: #0056b3;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            font-size: 10px; /* Ukuran font footer lebih kecil */
            color: #777;
            margin-top: 40px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 5px;
        }
        .row {
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-between;
        }
        .col-sm-6, .col-sm-3 {
            padding: 10px;
        }
        .col-sm-6 {
            flex: 0 0 50%;
            width: 50%;
        }
        .col-sm-3 {
            flex: 0 0 30%;
            width: 30%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px 10px; /* Mengurangi padding */
            border-bottom: 1px solid #ddd;
        }
        .fw-bold {
            font-weight: bold;
        }
        .badge {
            display: inline-block;
            padding: 3px 6px; /* Mengurangi padding badge */
            border-radius: 4px;
            color: #fff;
            font-weight: bold;
            font-size: 8px; /* Ukuran font badge lebih kecil */
        }
        .bg-danger {
            background-color: #dc3545;
        }
        .bg-success {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>LAPORAN KEGIATAN POSYANDUCARE</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <table>
                            <tr>
                                <td>Nama Kegiatan</td>
                                <td>: {{$kegiatan->nama_kegiatan}}</td>
                            </tr>
                            <tr>
                                <td>Puskesmas</td>
                                <td>: {{$lokasi->nama_puskesmas}}</td>
                            </tr>
                            <tr>
                                <td>Posyandu</td>
                                <td>: {{$lokasi->nama_posyandu}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Kegiatan</td>
                                <td>: {{$kegiatan->tgl_pelaksanaan}}</td>
                            </tr>
                            <tr>
                                <td>Jam Pelaksanaan</td>
                                <td>: {{$kegiatan->jam_pelaksanaan}}</td>
                            </tr>
                            <tr>
                                <td>Status Pelaksanaan</td>
                                <td>: {{$kegiatan->status}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pemeriksaan</th>
                    <th>Nama Orang Tua</th>
                    <th>Nama Anak</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia Anak</th>
                    <th>BB</th>
                    <th>TB</th>
                    <th>LK</th>
                    <th>Vitamin</th>
                    <th>Imunisasi</th>
                    <th>Status Stunting</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayats as $riwayat)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$riwayat->tgl_pemeriksaan}}</td>
                    <td>{{$riwayat->wali}}</td>
                    <td>{{$riwayat->nama}}</td>
                    <td>{{$riwayat->jk}}</td>
                    <td>{{($diff = date_diff(date_create($riwayat->tanggal_lahir), date_create('today')))->y . " tahun dan " . ($diff->days - ($diff->y * 365)) . " hari"}}</td>
                    <td>{{$riwayat->berat_badan}}</td>
                    <td>{{$riwayat->tinggi_badan}}</td>
                    <td>{{$riwayat->lingkar_kepala}}</td>
                    <td>{{$riwayat->vitamin}}</td>
                    <td>{{$riwayat->imunisasi}}</td>
                    <td>
                        @if ($riwayat->stunting == 'negative')
                            <span class="badge bg-success">{{$riwayat->stunting}}</span>
                        @endif
                        @if ($riwayat->stunting == 'positive')
                            <span class="badge bg-danger">{{$riwayat->stunting}}</span>
                        @endif
                    </td>
                    <td>{{$riwayat->keterangan}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <table>
                            <tr>
                                <td>Jumlah Peserta</td>
                                <td>: <span class="fw-bold">{{$countPeserta}} Anak</span></td>
                            </tr>
                            <tr>
                                <td>Jumlah Positive Stunting</td>
                                <td>: <span class="badge bg-danger">{{$countPositive}}</span></td>
                            </tr>
                            <tr>
                                <td>Jumlah Negative Stunting</td>
                                <td>: <span class="badge bg-success">{{$countNegative}}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Laporan ini dihasilkan oleh Sistem Monitoring PosyanduCare © {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>