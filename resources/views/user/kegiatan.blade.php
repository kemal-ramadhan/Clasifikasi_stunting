@extends('user.template')

@section('content')

@forelse ($kegiatans as $kegiatan)
@if ($kegiatan->status == "Berlangsung")
    
@endif
<div class="container mt-5">
    <h3 class="fw-bold mb-3">Kegiatan yang sedang berlangsung</h3>
    <div class="card mb-3">
        <div class="card-body">
            <span class="badge bg-primary mb-3">{{$kegiatan->status}}</span><br>
            <h5 class="fw-bold mb-3">
                {{$kegiatan->nama_posyandu}} - {{$kegiatan->nama_kegiatan}}
            </h5>
            <div class="d-flex justify-content-between mt-3">
                <h6 class="fw-bold">Tanggal : {{$kegiatan->tgl_pelaksanaan}}</h6>
                <h6 class="fw-bold">Jam : {{$kegiatan->jam_pelaksanaan}}</h6>
                <a href="/detail_kegiatan/{{$kegiatan->id}}" class="btn btn-primary">Detail Kegiatan</a>
            </div>
        </div>
    </div>
</div>
@empty
    
@endforelse

    <div class="container mt-5">
        <h3 class="fw-bold">Jadwal Kegiatan Posyandu</h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Posyandu</th>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Jam Pelaksanaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Posyandu</th>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Jam Pelaksanaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($kegiatans as $kegiatan)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$kegiatan->nama_posyandu}}</td>
                                <td>{{$kegiatan->nama_kegiatan}}</td>
                                <td>{{$kegiatan->tgl_pelaksanaan}}</td>
                                <td>{{$kegiatan->jam_pelaksanaan}}</td>
                                <td>
                                    @if ($kegiatan->status == 'Selesai')
                                        <span class="badge bg-success">{{$kegiatan->status}}</span>    
                                    @endif
                                    @if ($kegiatan->status == 'Berlangsung')
                                        <span class="badge bg-primary">{{$kegiatan->status}}</span>    
                                    @endif
                                    @if ($kegiatan->status == 'Akan Datang')
                                        <span class="badge bg-warning">{{$kegiatan->status}}</span>    
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="/detail_kegiatan/{{$kegiatan->id}}" class="badge bg-success">Daftar</a>
                                </td>
                            </tr>   
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection