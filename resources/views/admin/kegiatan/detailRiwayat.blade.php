@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/riwayat">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$kegiatan->nama_kegiatan}}</a></li>
    </ol>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <table class="table">
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
                <div class="col-sm-3">
                    <table class="table">
                        <tr>
                            <td>Jumlah Peserta</td>
                            <td>: <span class="fw-bold">{{$countPeserta}} Anak</span></td>
                        </tr>
                        <tr>
                            <td>Jumlah Positive Stunting</td>
                            <td>: <span class="badge bg-danger fw-bold">{{$countPositive}}</span></td>
                        </tr>
                        <tr>
                            <td>Jumlah Negative Stunting</td>
                            <td>: <span class="badge bg-success fw-bold">{{$countNegative}}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-5">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Kegiatan {{$kegiatan->nama_kegiatan}}</h6>
            <form action="/exportKegiatan" method="post">
                @csrf
                <input type="hidden" name="idRiwayat" value="{{$kegiatan->id}}">
                <input type="hidden" name="kegiatan" value="{{$kegiatan->nama_kegiatan}}">
            <div class="d-flex">
                <button class="btn btn-danger" style="margin-right: 10px;" type="submit" name="aksi" value="exportPdf">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                      </svg>
                    <span style="margin-left: 5px;">Download PDF</span> 
                </button>
                <button class="btn btn-success" type="submit" name="aksi" value="exportExcel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-xlsx" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252.284.091.665.091.507 0 .858-.158.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357 2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176.37.37 0 0 1-.143-.299q0-.234.184-.384.188-.152.513-.152.214 0 .37.068a.6.6 0 0 1 .245.181.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566 1.2 1.2 0 0 0-.5-.41 1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15-.336.149-.527.421-.19.273-.19.639 0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326.5.5 0 0 1-.085.29.56.56 0 0 1-.255.193q-.168.07-.413.07-.176 0-.32-.04a.8.8 0 0 1-.249-.115.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016-1.228-1.983h.931l.832 1.438h.036z"/>
                      </svg>
                    <span style="margin-left: 5px;">Download Excel</span> 
                </button>
            </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
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
                    <tfoot>
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
                    </tfoot>
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
            </div>
        </div>
    </div>
@endsection