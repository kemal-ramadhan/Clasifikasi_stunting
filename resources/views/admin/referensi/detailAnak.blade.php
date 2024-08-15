@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/ref-anak">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$anak->nama}}</a></li>
    </ol>

    <div class="card mt-3 col-sm-12 shadow-sm">
        <div class="card-body">
            <form action="/u_anak" method="post">
                @csrf
                <input type="hidden" name="idAnak" value="{{$anak->id}}">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-6 mb-3">
                    <label for="kb" class="form-label">Orang Tua</label>
                    <select class="js-example-basic-single" aria-label="Default select example" name="wali" style="width: 100%;">
                        @foreach ($ortus as $ortu)
                        @if ($ortu->id == $anak->idWali)
                        <option value="{{$ortu->id}}" selected>{{$ortu->nama}}</option>
                        @endif
                        <option value="{{$ortu->id}}">{{$ortu->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{$anak->nik}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$anak->nama}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="kb" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" aria-label="Default select example" name="jk">
                        <option value="{{$anak->jk}}" selected>{{$anak->jk}}</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="tempat" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat" name="tempat_lahir" value="{{$anak->tempat_lahir}}">
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="tgl" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl" name="tgl" value="{{$anak->tanggal_lahir}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan">{{$anak->keterangan}}</textarea>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nama" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="{{$anak->status}}">{{$anak->status}}</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mt-3">
                <button class="btn btn-primary" type="submit">Perbaharui Data</button>
              </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection