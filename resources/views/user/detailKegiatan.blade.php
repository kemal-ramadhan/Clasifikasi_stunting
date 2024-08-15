@extends('user.template')

@section('content')
<div class="container mt-5 mb-5">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/kegiatanPublic">Kegiatan</a></li>
        <li class="breadcrumb-item"><a>{{$kegiatan->nama_kegiatan}}</a></li>
    </ol>
    <h3 class="fw-bold mb-3">Kegiatan yang sedang berlangsung</h3>
    <div class="card mb-3 bg-body-tertiary">
        <div class="card-body">
            <span class="badge bg-primary mb-3">{{$kegiatan->status}}</span><br>
            <h5 class="fw-bold mb-3">
                {{$kegiatan->nama_posyandu}} - {{$kegiatan->nama_kegiatan}}
            </h5>
            <div class="d-flex justify-content-between mt-3">
                <h6 class="fw-bold">Tanggal : {{$kegiatan->tgl_pelaksanaan}}</h6>
                <h6 class="fw-bold">Jam : {{$kegiatan->jam_pelaksanaan}}</h6>
            </div>
        </div>
    </div>
</div>

@forelse ($anaks as $anak)
<div class="container mb-3">
    <div class="card">
        <div class="card-body">
            <span class="badge bg-primary">{{$anak->nik}}</span>
            <h5 class="fw-bold">{{$anak->nama}}</h5>
            <div class="row">
                <div class="col-sm-4">
                    <p>Jenis Kelamin : {{$anak->jk}}</p>
                    <p>Tempat, Tanggal Lahir : {{$anak->tempat_lahir}}, {{$anak->tanggal_lahir}}</p>
                </div>

                @php
                    $found = false;
                @endphp

                @foreach ($antrians as $antrian)
                    @if ($antrian->id_anak == $anak->id)
                        @php
                            $found = true;
                        @endphp
                        <div class="col-sm-6">
                            <div class="row text-center">
                                <div class="col-sm-4">
                                    <h3 class="fw-bold">{{$antrian->no_urut}}</h3>
                                    <h5 class="fw-bold">Nomor Antrian</h5>
                                </div>
                                <div class="col-sm-4">
                                    <h3 class="fw-bold">{{$antrian->estimasi}}</h3>
                                    <h5 class="fw-bold">Jam Pemeriksaan</h5>
                                </div>
                                <div class="col-sm-4">
                                    <h5 class="fw-bold bagde bg-warning">{{$antrian->status}}</h5>
                                    <h5 class="fw-bold">Status</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 text-center">
                            <a href="/hasil_pemeriksaan/{{$anak->id}}/{{$kegiatan->id}}" class="btn btn-success">Lihat Detail Pemeriksaan</a>
                        </div>
                    @endif
                @endforeach

                @if (!$found)
                    <div class="col-sm-6">
                        <div class="row text-center">
                            <div class="col-sm-4">
                                <h3 class="fw-bold">-</h3>
                                <h5 class="fw-bold">Nomor Antrian</h5>
                            </div>
                            <div class="col-sm-4">
                                <h3 class="fw-bold">-</h3>
                                <h5 class="fw-bold">Jam Pemeriksaan</h5>
                            </div>
                            <div class="col-sm-4">
                                <h3 class="fw-bold bagde bg-warning">-</h3>
                                <h5 class="fw-bold">Status</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 text-center">
                        <form action="/add_antrian_pemeriksaan/{{$anak->id}}" method="post">
                            @csrf
                            <input type="hidden" name="idKegiatan" value="{{$kegiatan->id}}">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin akan mendaftarkan {{$anak->nama}} dalam kegiatan?')">Daftar Pemeriksaan</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@empty
    <p>Tidak ada data anak yang ditemukan.</p>
@endforelse
@endsection