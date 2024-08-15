@extends('user.template')

@section('content')
<div class="container mt-5 mb-5">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/perkembangan">Anak</a></li>
        <li class="breadcrumb-item"><a>{{$anak->nama}}</a></li>
    </ol>
    <h3 class="fw-bold">Perkembangan {{$anak->nama}}</h3>
</div>

<div class="container">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                {!! $chartPertumbuhan->container() !!}
            </div>
        </div>
    </div>    
</div>

<div class="container">
    <!-- DataTales Example -->
    <div class="card shadow mt-3 mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Riwayat Pemeriksaan {{$anak->nama}}</h6>
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
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{ $chartPertumbuhan->cdn() }}"></script>
    {{ $chartPertumbuhan->script() }}
@endsection