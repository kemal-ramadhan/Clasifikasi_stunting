@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->    
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/kegiatan">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$kegiatan->nama_kegiatan}}</a></li>
    </ol>

    <form action="/u_kegiatan" method="post">
        @csrf
        <input type="hidden" name="idKegiatan" value="{{$kegiatan->id}}">
    <div class="card shadow-sm mt-3 col-sm-6">
        <div class="card-body">
            <div class="row">            
                <div class="col-sm-12 mb-3">
                    <label for="nama" class="form-label">Posyandu</label>
                    <select class="form-select" aria-label="Default select example" name="posyandu">
                        @foreach ($posyandus as $posyandu)
                        @if ($posyandu->id == $kegiatan->id_posyandu)
                        <option value="{{$posyandu->id}}" selected>{{$posyandu->nama_posyandu}}</option>
                        @endif
                        <option value="{{$posyandu->id}}">{{$posyandu->nama_posyandu}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="nama" class="form-label">Nama Kegiatan</label>
                    <input type="text" class="form-control" id="nama" name="kegiatan" value="{{$kegiatan->nama_kegiatan}}">
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="pelaksanaa" class="form-label">Tanggal Pelaksanaa</label>
                    <input type="date" class="form-control" id="pelaksanaan" name="pelaksanaan" value="{{$kegiatan->tgl_pelaksanaan}}">
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="pelaksanaa" class="form-label">Jam Pelaksanaa</label>
                    <input type="time" class="form-control" id="pelaksanaan" name="jam" value="{{$kegiatan->jam_pelaksanaan}}">
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="nama" class="form-label">Posyandu</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="{{$kegiatan->status}}" selected>{{$kegiatan->status}}</option>
                        <option value="Akan Datang">Akan Datang</option>
                        <option value="Berlangsung">Berlangsung</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mt-3">
                <button class="btn btn-primary" type="submit">Perbaharui Data</button>
            </div>
        </div>
    </div>
</form>
@endsection