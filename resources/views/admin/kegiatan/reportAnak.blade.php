@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/kegiatan">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$anak->nama}}</a></li>
    </ol>

    <div class="card mt-3 shadow-sm col-sm-12">
        <div class="card-body">
            <b>Biodata Anak</b>
            <hr>
            <div class="row mt-4">
                <div class="col-sm-6">
                    <label for="">NIK Anak</label>
                    <h4><b>{{$anak->nik}}</b></h4>
                </div>
                <div class="col-sm-6">
                    <label for="">Nama Anak</label>
                    <h4><b>{{$anak->nama}}</b></h4>
                </div>
                <div class="col-sm-6">
                    <label for="">Jenis Kelamin</label>
                    <h4><b>{{$anak->jk}}</b></h4>
                </div>
                <div class="col-sm-6">
                    <label for="">Tempat Lahir</label>
                    <h4><b>{{$anak->tempat_lahir}}</b></h4>
                </div>
                <div class="col-sm-6">
                    <label for="">Tanggal Lahir</label>
                    <h4><b>{{$anak->tanggal_lahir}}</b></h4>
                </div>
                <div class="col-sm-6">
                    <label for="">Usia</label>
                    <h4><b>{{date_diff(date_create($anak->tanggal_lahir), date_create('today'))->y}}</b></h4>
                </div>
                <div class="col-sm-6">
                    <label for="">Keterangan</label>
                    <h4><b>{{$anak->keterangan}}</b></h4>
                </div>
                <div class="col-sm-6">
                    <label for="">Nama Orang Tua Wali</label>
                    <h4><b>{{$anak->wali}}</b></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 mt-3">
        <div class="card">
            <div class="card-body">
                {!! $chartPertumbuhan->container() !!}
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mt-3 mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Riwayat Pemeriksaan Anak</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kegiatan</th>
                            <th>BB</th>
                            <th>TB</th>
                            <th>LK</th>
                            <th>Vitamin</th>
                            <th>Imunisasi</th>
                            <th>Status Stunting</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kegiatan</th>
                            <th>BB</th>
                            <th>TB</th>
                            <th>LK</th>
                            <th>Vitamin</th>
                            <th>Imunisasi</th>
                            <th>Status Stunting</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($riwayats as $riwayat)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$riwayat->tgl_pemeriksaan}}</td>
                            <td>{{$riwayat->nama_kegiatan}}</td>
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
                            <td>{{$riwayat->status}}</td>
                            <td><a href="/detail_pemeriksaan/{{$riwayat->idPemeriksaan}}" class="badge bg-success">Detail Pemeriksaan</a></td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ $chartPertumbuhan->cdn() }}"></script>
    {{ $chartPertumbuhan->script() }}
@endsection