@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/riwayat">{{$title}}</a></li>
    </ol>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Kegiatan</h6>
            
        </div>
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
                                <a href="/e_kegiatan/{{$kegiatan->id}}" class="badge bg-success">Edit</a>
                                <a href="/d_riwayat_kegiatan/{{$kegiatan->id}}" class="badge bg-primary">Detail Kegiatan</a>
                            </td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection