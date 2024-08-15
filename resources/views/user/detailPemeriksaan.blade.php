@extends('user.template')

@section('content')
<div class="container mt-5 mb-5">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/kegiatanPublic}}">Kegiatan</a></li>
        <li class="breadcrumb-item"><a href="/detail_kegiatan/{{$kegiatan->id}}">{{$kegiatan->nama_kegiatan}}</a></li>
        <li class="breadcrumb-item"><a>{{$anak->nama}}</a></li>
    </ol>
    <h3 class="fw-bold mb-3">Kegiatan</h3>
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

@if ($pemeriksaan != null)
<div class="container">
    <h3 class="fw-bold">Hasil Pemeriksaan</h3>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tanggal Pemeriksaan</th>
                    <th scope="col">Nama Anak</th>
                    <th scope="col">BB</th>
                    <th scope="col">TB</th>
                    <th scope="col">LK</th>
                    <th scope="col">Vitamin</th>
                    <th scope="col">Imunisasi</th>
                    <th scope="col">Status Stunting</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$pemeriksaan->tgl_pemeriksaan}}</td>
                    <td>{{$pemeriksaan->nama}}</td>
                    <td>{{$pemeriksaan->berat_badan}}</td>
                    <td>{{$pemeriksaan->tinggi_badan}}</td>
                    <td>{{$pemeriksaan->lingkar_kepala}}</td>
                    <td>{{$pemeriksaan->vitamin}}</td>
                    <td>{{$pemeriksaan->imunisasi}}</td>
                    <td>
                      @if ($pemeriksaan->stunting == 'negative')
                          <span class="badge bg-success">{{$pemeriksaan->stunting}}</span>
                      @endif
                      @if ($pemeriksaan->stunting == 'positive')
                          <span class="badge bg-danger">{{$pemeriksaan->stunting}}</span>
                      @endif
                  </td>
                    <td>{{$pemeriksaan->keterangan}}</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>
@else
<div class="container">
    <h3 class="fw-bold">Hasil Pemeriksaan</h3>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tanggal Pemeriksaan</th>
                    <th scope="col">Nama Anak</th>
                    <th scope="col">BB</th>
                    <th scope="col">TB</th>
                    <th scope="col">LK</th>
                    <th scope="col">Vitamin</th>
                    <th scope="col">Imunisasi</th>
                    <th scope="col">Status Stunting</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>
@endif
@endsection