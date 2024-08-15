@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/kegiatan">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$antrian->nama}}</a></li>
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

    <div class="card mt-3 col-sm-12 shadow-sm">
        <div class="card-body">
        <form action="/c_pemeriksaan" method="post">
                @csrf
                <input type="hidden" name="idAntrian" value="{{$antrian->idAntrian}}">
                <input type="hidden" name="idKegiatan" value="{{$antrian->idKegiatan}}">
                <input type="hidden" name="idAnak" value="{{$anak->id}}">
            <b>Pemeriksaan : {{$antrian->nama_kegiatan}}</b>
            <hr>
            <div class="row">
                <div class="mb-3 col-sm-4">
                    <label for="bb" class="form-label">Berat Badan</label>
                    <input type="text" class="form-control" id="bb" placeholder="Berat Badan" name="bb">
                </div>
                <div class="mb-3 col-sm-4">
                    <label for="tb" class="form-label">Tinggi Badan</label>
                    <input type="text" class="form-control" id="tb" placeholder="Tinggi Badan" name="tb">
                </div>
                <div class="mb-3 col-sm-4">
                    <label for="lk" class="form-label">Lingkar Kepala</label>
                    <input type="text" class="form-control" id="lk" placeholder="Tinggi Badan" name="lk">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-sm-4">
                    <label for="vitamin" class="form-label">Vitamin</label>
                    <input type="text" class="form-control" id="vitamin" placeholder="Vitamin" name="vitamin">
                </div>
                <div class="mb-3 col-sm-4">
                    <label for="imunisasi" class="form-label">Imunisasi</label>
                    <input type="text" class="form-control" id="imunisasi" placeholder="Imunisasi" name="imunisasi">
                </div>
                <div class="mb-3 col-sm-4">
                    <label for="lk" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan"></textarea>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mt-3">
                <button class="btn btn-primary" type="submit">Simpan Data & Lanjutkan</button>
            </div>
        </form>
        </div>
    </div>
@endsection