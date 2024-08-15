@extends('user.template')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 py-5">
                <img src="{{asset('assets/images/icons/kel.png')}}" alt="kelurahan" style="max-width: 150px;" class="mb-5">
                <h1 class="fw-bold">PosyanduCARE</h1>
                <p class="col-sm-8 mt-3 mb-3">PosyanduCare Merupakan layanan kesehatan yang diinisiasi oleh kelurahan cibaduyut untuk menangani dan mengedukasi seputar perkembangan anak khususnya stunting.</p>
                <a href="/kegiatanPublic" class="btn btn-primary mb-3">Lihat Kegiatan Posyandu</a>
            </div>
            <div class="col-sm-6">
                <img src="{{asset('assets/images/icons/home.png')}}" alt="home" style="width: 100%;">
            </div>
        </div>
    </div>

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